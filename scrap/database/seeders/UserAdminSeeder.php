<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create a sample user
       User::create([
        'name' => 'Raksha Rajput',
        'email' => 'raksha@gmail.com',
        'mobile'=> '1234567890',
        'city' => 'Mumbai',
        'pincode' => '123456',
        'address' => 'Mumbai',
        'role'=> '2',
        'unique_id'=>'USR-002',
        'password' => Hash::make(123),
    ]);
    }
}
