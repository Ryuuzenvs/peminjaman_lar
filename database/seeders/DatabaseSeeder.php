<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Borrower;
use App\Models\Officer;
use App\Models\category;
use App\Models\tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
/*
$kategoris = [
['nama_kategori' => 'alat tulis'],
['nama_kategori' => 'alat berat'],
['nama_kategori' => 'alat pembersih']
];

foreach($kategoris as $kategori){
category::create($kategori);
};

$alats = [
['name_tools' => 'pensil', 'category_id'=> 1, 'stock'=>'10'],
['name_tools' => 'berat', 'category_id'=> 2, 'stock'=>'10'],
['name_tools' => 'sapu', 'category_id'=> 3, 'stock'=>'10'],
];

foreach($alats as $alat){
tool::create($alat);
};
*/

    }
}

