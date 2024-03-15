<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample user
        User::create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'city' => 'Mumbai',
            'pincode' => '123456',
            'address' => 'Mumbai',
            'role'=> '1',
            'password' => Hash::make(123),
        ]);

    }
}
