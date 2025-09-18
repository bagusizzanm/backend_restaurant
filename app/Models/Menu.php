<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $fillable = ['name', 'price', 'type', 'description'];
  public function order_item()
  {
    return $this->hasMany(OrderItem::class);
  }
}
