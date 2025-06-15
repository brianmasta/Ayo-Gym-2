<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@ag.com',
                'password' => Hash::make('secret'),
                'role' => 'admin',
            ],

            [
                'name' => 'Kasir',
                'email' => 'kasir@ag.com',
                'password' => Hash::make('secret'),
                'role' => 'kasir',
            ],

        ];

        foreach ($users as $data) {
            User::create($data);
        }

    }
}
