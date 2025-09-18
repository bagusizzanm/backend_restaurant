<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
  public function index()
  {
    $menu = Menu::all();
    return response()->json($menu);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'price' => 'required|numeric',
      'type' => 'required|in:food,drink',
    ]);

    $menu = Menu::create($request->all());
    return response()->json([
      'data' => $menu,
      'message' => 'Menu baru tersimpan'
    ]);
  }

  public function show($id)
  {
    $menu = Menu::findOrFail($id);
    return response()->json($menu);
  }

  public function update(Request $request, $id)
  {
    $menu = Menu::findOrFail($id);
    $menu->update($request->all());
    return response()->json(['data' => $menu, 'message' => 'Menu terupdate']);
  }

  public function destroy($id)
  {
    $menu = Menu::findOrFail($id);
    $menu->delete();
    return response()->json(['message' => 'Menu dihapus']);
  }
}
