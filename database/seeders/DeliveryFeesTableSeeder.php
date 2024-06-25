<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('delivery_fees')->insert([
            ['city' => 'Colombo', 'price' => '150'],
            ['city' => 'Other', 'price' => '250'],
        ]);
    }
}
