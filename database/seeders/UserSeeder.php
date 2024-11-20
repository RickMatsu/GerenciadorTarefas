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
        User::create([
            'name' => 'Ricardo',
            'email' => 'ricardo@admin.com',
            'password' => bcrypt('Gh0strecon1'),
            'role' => 'admin',
        ]);
    }
}
