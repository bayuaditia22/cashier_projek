<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin_Caffe_22'),
                'level' => 1
            ],
            [
                'name' => 'kasir1',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('Kasir_Caffe_23'),
                'level' => 2
            ],
            [
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('Owner_Caffe_24'),
                'level' => 3
            ]
        ];

        foreach ($user as $key => $value) { 
            User::create($value);
        }
    }
}
