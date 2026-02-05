<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Alat Pertukangan'],
            ['nama_kategori' => 'Alat Elektronik'],
            ['nama_kategori' => 'Alat Ukur'],
            ['nama_kategori' => 'Kebersihan'],
        ];

        foreach ($categories as $cat) {
            category::create($cat);
        }
    }
}
