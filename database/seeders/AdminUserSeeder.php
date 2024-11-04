<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'loki@example.com',
            'password' => Hash::make('loki1995'), // Default password: 'password'
            'is_admin' => true,
        ]);
    }
}
