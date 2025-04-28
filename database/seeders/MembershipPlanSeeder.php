<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => 'Harian',   'duration_days' => 1,   'price' => 25000],
            ['name' => 'Mingguan', 'duration_days' => 7,   'price' => 100000],
            ['name' => 'Bulanan',  'duration_days' => 30,  'price' => 300000],
            ['name' => 'Tahunan',  'duration_days' => 365, 'price' => 2000000],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::updateOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }
    }
}
