<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\TableRestaurant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
  //@desc GET /api/orders
  public function index(Request $request)
  {
    $query = Order::with(['table', 'user', 'items.menu']);

    if ($request->has('status') && in_array($request->status, ['open', 'closed'])) {
      $query->where('status', $request->status);
    }

    if ($request->has('table')) {
      $query->whereHas('table', function ($q) use ($request) {
        $q->where('number', $request->table);
      });
    }

    $orders = $query->orderBy('created_at', 'desc')->get();

    return response()->json($orders);
  }

  // POST /api/orders
  public function store(Request $request)
  {
    $request->validate([
      'table_restaurant_id' => 'required|exists:table_restaurants,id',
    ]);

    $table = TableRestaurant::findOrFail($request->table_restaurant_id);

    // Cek apakah meja kosong
    if ($table->status === 'occupied') {
      return response()->json(['message' => 'Meja ini tidak kosong'], 400);
    }

    // Buat order baru
    $order = Order::create([
      'table_restaurant_id' => $table->id,
      // 'user_id' => $request->user()->id,
      'status' => 'open',
      'total_price' => 0,
    ]);

    // Update status meja menjadi occupied
    $table->update(['message' => 'Meja telah dipesan', 'status' => 'occupied']);

    return response()->json([
      'message' => 'Pemesanan meja berhasil',
      'order' => $order
    ], 201);
  }

  public function show($id)
  {
    $order = Order::with(['items.menu'])->findOrFail($id);
    return response()->json($order);
  }

  public function addItem(Request $request, $id)
  {
    $request->validate([
      'menu_id' => 'required|exists:menus,id',
      'qty' => 'required|integer|min:1'
    ]);

    $order = Order::findOrFail($id);

    if ($order->status !== 'open') {
      return response()->json(['message' => 'Pesanan sudah ditutup, tidak bisa menambah item'], 400);
    }

    $menu = Menu::findOrFail($request->menu_id);
    $subtotal = $menu->price * $request->qty;

    $item = $order->items()->create([
      'menu_id' => $menu->id,
      'qty' => $request->qty,
      'subtotal' => $subtotal
    ]);

    // update total harga
    $order->total_price += $subtotal;
    $order->save();

    return response()->json([
      'message' => 'Item pesanan berhasil ditambahkan',
      'order' => $order->load('items.menu')
    ], 201);
  }

  public function close($id)
  {
    $order = Order::with('table')->findOrFail($id);

    if ($order->status === 'closed') {
      return response()->json(['message' => 'Pesanan sudah ditutup'], 400);
    }

    $order->status = 'closed';
    $order->save();

    // update status meja jadi available
    if ($order->table) {
      $order->table->status = 'available';
      $order->table->save();
    }
    return response()->json([
      'message' => 'Order closed successfully',
      'order' => $order
    ]);
  }


  // GET /api/orders/{id}/receipt
  public function receipt($id)
  {
    $order = Order::with(['items.menu', 'table', 'user'])->findOrFail($id);

    if ($order->status !== 'closed') {
      return response()->json(['message' => 'Nota hanya untuk pesanan yang sudah ditutup'], 400);
    }

    $pdf = Pdf::loadView('pdf.receipt', compact('order'));

    return $pdf->download('receipt_order_' . $order->id . '.pdf');
  }
}
