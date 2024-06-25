<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['name' => 'Central Province'],
            ['name' => 'Eastern Province'],
            ['name' => 'Northern Province'],
            ['name' => 'North Central Province'],
            ['name' => 'North Western Province'],
            ['name' => 'Sabaragamuwa Province'],
            ['name' => 'Southern Province'],
            ['name' => 'Uva Province'],
            ['name' => 'Western Province'],
        ]);
    }
}
