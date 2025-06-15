<?php

namespace Database\Seeders;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            // Member Payment
            [
                'member_id' => 1,
                'non_member_id' => null,
                'member_code' => 'AG-0001',
                'user_id' => 1,
                'membership_plan_id' => 1,
                'amount' => 150000,
                'method' => 'cash',
                'order_id' => 1,
                'payment_type' => 'bank_transfer',
                'transaction_id' => 1,
                'payment_date' => Carbon::now()->subDays(2),
            ],
            // Non Member Payment
            [
                'member_id' => null,
                'non_member_id' => 1,
                'user_id' => 1,
                'membership_plan_id' => 2,
                'amount' => 200000,
                'method' => 'online',
                'order_id' => 1,
                'payment_type' => 'bank_transfer',
                'transaction_id' => 2,
                'payment_date' => Carbon::now()->subDay(),
            ],
            // Member Payment
            [
                'member_id' => 2,
                'non_member_id' => null,
                'user_id' => 1,
                'member_code' => 'AG-0001',
                'membership_plan_id' => 3,
                'amount' => 300000,
                'method' => 'online',
                'order_id' => 1,
                'payment_type' => 'bank_transfer',
                'transaction_id' => 3,
                'payment_date' => Carbon::now(),
            ],
        ];

        foreach ($payments as $data) {
            Payment::create($data);
        }
    }
}
