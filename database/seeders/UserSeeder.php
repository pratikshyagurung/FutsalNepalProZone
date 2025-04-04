<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Admin user

        $user = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'phone' => '9800000000',
                'dob' => '2004-06-11',
                'address' => 'KamalPokhari',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin1'),
                'role' => 'admin',
            ],
            [
                'first_name' => 'Futsal',
                'last_name' => 'Owner',
                'phone' => '9800000001',
                'dob' => '2004-06-12',
                'address' => 'Miyapatan',
                'email' => 'futsal_owner@gmail.com',
                'password' => Hash::make('futsal_owner1'),
                'role' => 'futsal_owner',
            ],


            [
                'first_name' => 'Normal',
                'last_name' => 'User',
                'phone' => '9817172739',
                'dob' => '2004-06-13',
                'address' => 'BP Marga',
                'email' => 'pratikshyag82@gmail.com',
                'password' => Hash::make('user1'),
                'role' => 'user',
            ]
        ];
        User::insert($user);
    }
}
