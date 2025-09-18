<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $fillable = ['table_restaurant_id', 'user_id', 'status', 'total_price'];


  public function order_item()
  {
    return $this->hasMany(OrderItem::class);
  }

  public function table()
  {
    return $this->belongsTo(TableRestaurant::class, 'table_restaurant_id');
  }

  // Relasi ke User (pelayan yang membuka order)
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Relasi ke OrderItem
  public function items()
  {
    return $this->hasMany(OrderItem::class);
  }
}
