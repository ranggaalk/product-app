<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@product.app',
            'password' => Hash::make('admin'),
            'role' => 1
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@product.app',
            'password' => Hash::make('admin'),
            'role' => 2
        ]);

        for($i=1;$i<=100;$i++){
            Product::create([
                'user_id' => 1,
                'name' => fake()->word(),
                'purchase_price' => fake()->numberBetween(10000, 20000),
                'selling_price' => fake()->numberBetween(21000, 100000),
                'thumbnail' => null,
                'stock' => fake()->randomNumber(2, false),
            ]);
        }
    }
}
