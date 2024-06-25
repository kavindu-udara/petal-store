<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => ' hanging planters'],
            ['name' => 'herb planters'],
            ['name' => 'windowsill planters'],
            ['name' => 'planter with legs'],
            ['name' => 'terrariums'],
        ]);
    }
}
