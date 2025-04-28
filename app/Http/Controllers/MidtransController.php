<?php

namespace App\Http\Controllers;

use App\Livewire\Payment;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Temukan pembayaran berdasarkan order_id
        $payment = Payment::where('order_id', $request->order_id)->first();

        if ($payment && $request->transaction_status == 'settlement') {
            $payment->update([
                'status' => 'success',
                'paid_at' => now(),
                'transaction_id' => $request->transaction_id,
                'payment_type' => $request->payment_type,
            ]);
        }

        return response()->json(['message' => 'Callback received']);
    }
}
