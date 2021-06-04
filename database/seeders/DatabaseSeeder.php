<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name'=>'testuser','email'=>'testuser@example.com','password'=>Hash::make('testuser')]);
        User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(10)->create();
        Order::factory(10)->create();
    }
}
