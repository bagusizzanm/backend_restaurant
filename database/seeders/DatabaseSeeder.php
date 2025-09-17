<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use App\Models\TableRestaurant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Table;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    User::create([
      'name' => 'Kasir',
      'email' => 'kasir@gmail.com',
      'password' => bcrypt('password'),
      'role' => 'kasir'
    ]);

    User::create([
      'name' => 'Pelayan',
      'email' => 'server@gmail.com',
      'password' => bcrypt('password'),
      'role' => 'pelayan'
    ]);

    for ($i = 1; $i <= 10; $i++) {
      TableRestaurant::create([
        'number' => $i,
        'status' => 'available'
      ]);
    }

    Menu::create([
      'name' => 'Nasi Goreng',
      'price' => 20000,
      'type' => 'food'
    ]);

    Menu::create([
      'name' => 'Es Teh Manis',
      'price' => 5000,
      'type' => 'drink'
    ]);
  }
}
