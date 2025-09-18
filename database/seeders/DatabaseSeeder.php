<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use App\Models\TableRestaurant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {

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
      'type' => 'Main Course'
    ]);

    Menu::create([
      "name" => "Kentang Goreng",
      "price" => 20000,
      "type" => "Appetizer",
      "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat magni dolor excepturi porro nostrum eius dolorum ducimus adipisci autem assumenda soluta, aspernatur architecto saepe reprehenderit obcaecati perspiciatis consequuntur quasi "
    ]);


    Menu::create([
      'name' => 'Es Teh Manis',
      'price' => 5000,
      'type' => 'Beverage'
    ]);
    $this->generateTable();
  }
  public function generateTable()
  {
    Schema::disableForeignKeyConstraints();

    TableRestaurant::truncate();

    Schema::enableForeignKeyConstraints();

    for ($i = 1; $i <= 10; $i++) {
      TableRestaurant::create([
        'number' => $i,
        'status' => 'available'
      ]);
    }
  }
}
