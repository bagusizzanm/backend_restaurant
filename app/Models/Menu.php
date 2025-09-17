<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $fillable = ['name', 'price', 'type', 'description'];
  public function order_items()
  {
    return $this->hasMany(OrderItems::class);
  }
}
