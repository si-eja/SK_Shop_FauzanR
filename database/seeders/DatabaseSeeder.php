<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'level' => 'admin',
        ]);
        Kategori::create([
            'nama_kategori' => 'Elektronik',
        ]);
        Kategori::create([
            'nama_kategori' => 'Pakaian',
        ]);
        Kategori::create([
            'nama_kategori' => 'Makanan',
        ]);
    }
}
