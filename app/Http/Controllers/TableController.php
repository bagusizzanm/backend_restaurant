<?php

namespace App\Http\Controllers;

use App\Models\TableRestaurant;

class TableController extends Controller
{
  public function index()
  {
    $tables = TableRestaurant::with('order')->get();

    return response()->json($tables);
  }
}
