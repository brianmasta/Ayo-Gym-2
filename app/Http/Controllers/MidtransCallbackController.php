<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Notifikasi dari Midtrans
        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $orderId = $notif->order_id;
        $grossAmount = $notif->gross_amount;
        $transactionId = $notif->transaction_id;

        if ($transactionStatus === 'settlement') {
            // Pastikan order_id valid (bisa disimpan dari session sebelumnya)
            $memberData = session('member_data'); // atau simpan sementara di DB untuk query ulang

            if ($memberData) {
                // Simpan Member
                $member = Member::create([
                    'name' => $memberData['name'],
                    'email' => $memberData['email'],
                    'phone' => $memberData['phone'],
                    'birthdate' => $memberData['birthdate'],
                    'gender' => $memberData['gender'],
                    'address' => $memberData['address'],
                    'member_code' => $memberData['member_code'],
                    'membership_plan_id' => $memberData['membership_plan_id'],
                    'method' => 'midtrans',
                    'amount' => $grossAmount,
                    'join_date' => $memberData['join_date'],
                    'expire_date' => $memberData['expire_date'],
                ]);

                // Simpan pembayaran
                Payment::create([
                    'member_id' => $member->id,
                    'membership_plan_id' => $memberData['membership_plan_id'],
                    'amount' => $grossAmount,
                    'method' => $paymentType,
                    'status' => $transactionStatus,
                    'order_id' => $orderId,
                    'transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);
            }
        }

        return response()->json(['message' => 'Callback handled']);
    }
}
