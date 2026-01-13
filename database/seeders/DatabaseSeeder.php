<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'peminjam',
            'email' => 'ryuu@example.com',
            'password' => hash::make('12345678'),
            'role' => 'peminjam'
        ]);
        User::factory()->create([
            'name' => 'owner',
            'email' => 'ryuu@example.com',
            'password' => hash::make('12345678'),
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'petugas',
            'email' => 'ryuuown@example.com',
            'password' => hash::make('12345678'),
            'role' => 'petugas'
        ]);
    }
}
