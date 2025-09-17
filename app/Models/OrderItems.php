<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
  use HasFactory;

  protected $fillable = ['order_id', 'menu_id', 'qty', 'subtotal'];

  // Relasi ke Order
  public function order()
  {
    return $this->belongsTo(Orders::class);
  }

  // Relasi ke Menu
  public function menu()
  {
    return $this->belongsTo(Menu::class);
  }
}
