<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableRestaurant extends Model
{
  use HasFactory;

  protected $fillable = ['number', 'status'];

  public function orders()
  {
    return $this->hasMany(Orders::class);
  }
}
