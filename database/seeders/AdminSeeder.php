<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Ziad',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123456'),
        ]);

        Admin::create([
            'name' => 'AYA',
            'email' => 'admin2@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
