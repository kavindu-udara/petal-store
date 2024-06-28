<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'fname' => 'Admin',
            'lname' => 'LastAdmin',
            'status' => '0',
            'email' => 'udarakavindu99@gmail.com',
            'password' => '$2y$12$zcUbYrRBf/vHv1GiOstQb.mohYMgeRU/6TnH2TaGkVvW.qe4OAbEK',
        ]);
    }
}
