<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  //
  use HasFactory;
  protected $fillable = ['table_id', 'user_id', 'status', 'total_price'];

  public function order_items()
  {
    return $this->hasMany(OrderItems::class);
  }

  public function table()
  {
    return $this->belongsTo(TableRestaurant::class);
  }

  // Relasi ke User (pelayan yang membuka order)
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Relasi ke OrderItem
  public function items()
  {
    return $this->hasMany(OrderItems::class);
  }
}
