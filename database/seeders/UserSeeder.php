<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'john',
            'email' => 'john@gmail.com',
            'password' => Hash::make('222222'),
        ]);

//        User::create([
//            'name' => 'frank',
//            'email' => 'frank@gmail.com',
//            'password' => Hash::make('333333'),
//        ]);
    }
}
