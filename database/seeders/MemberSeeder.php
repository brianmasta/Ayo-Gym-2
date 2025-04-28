<?php

namespace Database\Seeders;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@gym.com',
                'phone' => '081234567890',
                'address' => 'Jl. Kebugaran No. 1',
                'birthdate' => '1995-04-12',
                'gender' => 'L',
                'join_date' => '2023-01-10',
                'membership_plan_id' => 1,
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(1),
                'status' => 'active',
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti@gym.com',
                'phone' => '081234567891',
                'address' => 'Jl. Fitness No. 2',
                'birthdate' => '1998-08-20',
                'gender' => 'P',
                'join_date' => '2023-02-05',
                'membership_plan_id' => 2,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(4),
                'status' => 'active',
            ],
            [
                'name' => 'Joko Susanto',
                'email' => 'joko@gym.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gymnesia No. 3',
                'birthdate' => '1990-12-05',
                'gender' => 'L',
                'join_date' => '2022-09-01',
                'membership_plan_id' => 3,
                'start_date' => Carbon::now()->subDays(40),
                'end_date' => Carbon::now()->subDays(10),
                'status' => 'inactive',
            ],
        ];

        foreach ($members as $data) {
            Member::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}
