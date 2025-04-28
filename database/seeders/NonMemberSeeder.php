<?php

namespace Database\Seeders;

use App\Models\NonMember;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nonMembers = [
            [
                'name' => 'Rina Putri',
                'phone' => '081234000001',
                'visit_purpose' => 'Trial Gym',
                'visit_date' => Carbon::now()->subDays(1),
            ],
            [
                'name' => 'Fajar Hidayat',
                'phone' => '081234000002',
                'visit_purpose' => 'Temani Teman',
                'visit_date' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Lusi Wulandari',
                'phone' => '081234000003',
                'visit_purpose' => 'Tanya Paket',
                'visit_date' => Carbon::now(),
            ],
        ];

        foreach ($nonMembers as $data) {
            NonMember::updateOrCreate(
                ['phone' => $data['phone']],
                $data
            );
        }
    }
}
