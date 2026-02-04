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
    public function run() {
    \App\Models\Admin::create(['username' => 'Admin', 'email' => 'admin@test.com', 'password' => bcrypt('123')]);
    \App\Models\Officer::create(['username' => 'Petugas', 'email' => 'petugas@test.com', 'password' => bcrypt('123')]);
    \App\Models\Borrower::create(['username' => 'Siswa', 'email' => 'siswa@test.com', 'password' => bcrypt('123')]);
}
}
