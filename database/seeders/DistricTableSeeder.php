<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistricTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->insert([
            ['name' => 'Kandy','province_id' => '1',],
            ['name' => 'Matale','province_id' => '1',],
            ['name' => 'Nuwara Eliya', 'province_id' => '1',],

            ['name' => 'Ampara','province_id' => '2',],
            ['name' => 'Batticaloa','province_id' => '2',],
            ['name' => 'Trincomalee','province_id' => '2',],

            ['name' => 'Jaffna','province_id' => '3',],
            ['name' => 'Kilinochchi', 'province_id' => '3', ],
            ['name' => 'Mannar', 'province_id' => '3',],
            ['name' => 'Mullaitivu', 'province_id' => '3',],
            ['name' => 'Vavuniya', 'province_id' => '3',],

            ['name' => 'Anuradhapura', 'province_id' => '4',],
            ['name' => 'Polonnaruwa', 'province_id' => '4',],

            ['name' => 'Kurunegala', 'province_id' => '5',],
            ['name' => 'Puttalam', 'province_id' => '5',],

            ['name' => 'Kegalle', 'province_id' => '6',],
            ['name' => 'Ratnapura', 'province_id' => '6',],

            ['name' => 'Galle', 'province_id' => '7',],
            ['name' => 'Hambantota', 'province_id' => '7',],
            ['name' => 'Matara', 'province_id' => '7',],

            ['name' => 'Badulla', 'province_id' => '8',],
            ['name' => 'Moneragala', 'province_id' => '8',],

            ['name' => 'Colombo', 'province_id' => '9',],
            ['name' => 'Gampaha', 'province_id' => '9',],
            ['name' => 'Kalutara', 'province_id' => '9',],
        ]);
    }
}
