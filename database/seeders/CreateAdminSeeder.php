<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('admin123'),
            ],           
        ];

        foreach ($data as $key => $user) {
            Admin::create($user);
        }
    }
}
