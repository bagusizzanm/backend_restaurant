<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);

  // Menu
  Route::apiResource('menus', MenuController::class);
  // List Meja
  Route::get('/tables', [TableController::class, 'index']);
  // Open Order
  Route::get('/orders', [OrderController::class, 'index']);
  Route::post('/orders', [OrderController::class, 'store']);
  Route::get('/orders/{id}', [OrderController::class, 'show']);
  Route::post('/orders/{id}/items', [OrderController::class, 'addItem']);
  Route::post('/orders/{id}/close', [OrderController::class, 'close']);
  Route::get('/orders/{id}/receipt', [OrderController::class, 'receipt']);
});
