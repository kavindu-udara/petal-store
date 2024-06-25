<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'fname' => 'fname',
                'lname' => 'lname',
                'email' => 'user@gmail.com',
                'type' => 'user',
                'mobile' => '0776040673',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
