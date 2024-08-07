<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'nik' => '1234567890',
            'email' => 'admin@gmail.com',
            'phone' => '082185068528',
            'password' => Hash::make('0815225ok'), // Pastikan untuk menggunakan hash untuk password
            'role' => 'admin', // Pastikan ada kolom 'role' di tabel 'users'
            'is_verified' => true, // Admin langsung terverifikasi
        ]);
    }
}
