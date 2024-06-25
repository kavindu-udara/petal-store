<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Kandy', 'district_id' => 1],
            ['name' => 'Gampola', 'district_id' => 1],
            ['name' => 'Matale', 'district_id' => 2],
            ['name' => 'Dambulla', 'district_id' => 2],
            ['name' => 'Nuwara Eliya', 'district_id' => 3],
            ['name' => 'Hatton', 'district_id' => 3],
            ['name' => 'Ampara', 'district_id' => 4],
            ['name' => 'Kalmunai', 'district_id' => 4],
            ['name' => 'Batticaloa', 'district_id' => 5],
            ['name' => 'Eravur', 'district_id' => 5],
            ['name' => 'Trincomalee', 'district_id' => 6],
            ['name' => 'Kinniya', 'district_id' => 6],
            ['name' => 'Jaffna', 'district_id' => 7],
            ['name' => 'Point Pedro', 'district_id' => 7],
            ['name' => 'Kilinochchi', 'district_id' => 8],
            ['name' => 'Pooneryn', 'district_id' => 8],
            ['name' => 'Mannar', 'district_id' => 9],
            ['name' => 'Pesalai', 'district_id' => 9],
            ['name' => 'Mullaitivu', 'district_id' => 10],
            ['name' => 'Puthukkudiyiruppu', 'district_id' => 10],
            ['name' => 'Vavuniya', 'district_id' => 11],
            ['name' => 'Nedunkeni', 'district_id' => 11],
            ['name' => 'Anuradhapura', 'district_id' => 12],
            ['name' => 'Kekirawa', 'district_id' => 12],
            ['name' => 'Polonnaruwa', 'district_id' => 13],
            ['name' => 'Hingurakgoda', 'district_id' => 13],
            ['name' => 'Kurunegala', 'district_id' => 14],
            ['name' => 'Kuliyapitiya', 'district_id' => 14],
            ['name' => 'Puttalam', 'district_id' => 15],
            ['name' => 'Chilaw', 'district_id' => 15],
            ['name' => 'Kegalle', 'district_id' => 16],
            ['name' => 'Warakapola', 'district_id' => 16],
            ['name' => 'Ratnapura', 'district_id' => 17],
            ['name' => 'Balangoda', 'district_id' => 17],
            ['name' => 'Galle', 'district_id' => 18],
            ['name' => 'Hikkaduwa', 'district_id' => 18],
            ['name' => 'Hambantota', 'district_id' => 19],
            ['name' => 'Tangalle', 'district_id' => 19],
            ['name' => 'Matara', 'district_id' => 20],
            ['name' => 'Weligama', 'district_id' => 20],
            ['name' => 'Badulla', 'district_id' => 21],
            ['name' => 'Bandarawela', 'district_id' => 21],
            ['name' => 'Moneragala', 'district_id' => 22],
            ['name' => 'Bibile', 'district_id' => 22],
            ['name' => 'Colombo', 'district_id' => 23],
            ['name' => 'Dehiwala-Mount Lavinia', 'district_id' => 23],
            ['name' => 'Gampaha', 'district_id' => 24],
            ['name' => 'Negombo', 'district_id' => 24],
            ['name' => 'Kalutara', 'district_id' => 25],
            ['name' => 'Beruwala', 'district_id' => 25],
        ]);
        
    }
}
