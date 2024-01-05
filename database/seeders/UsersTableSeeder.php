<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // admin
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'phone' => '09123123123',
                'address' => 'Nay Pyi Taw',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],

            // instructor
            [
                'name' => 'Instructor',
                'email' => 'instructor@mail.com',
                'phone' => '09123123123',
                'address' => 'Nay Pyi Taw',
                'password' => Hash::make('password'),
                'role' => 'instructor'
            ],

            // user
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'phone' => '09223344111',
                'address' => 'Nay Pyi Taw',
                'password' => Hash::make('password'),
                'role' => 'user'
            ],
        ]);
    }
}
