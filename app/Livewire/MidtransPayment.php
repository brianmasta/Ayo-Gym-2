<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Midtrans\Snap;

class MidtransPayment extends Component
{
    public $memberData;
    public $snapToken;

    public function mount()
    {
        if (!session()->has('member_data')) {
            return redirect()->to('/members');
        }

        $this->memberData = session('member_data');
        // $this->pay();
    }

    public function pay()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        $orderId = 'NON-' . Str::uuid();
    
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $this->memberData['amount'],
            ],
            'customer_details' => [
                'first_name' => $this->memberData['name'],
                'email' => 'brianmasta@gmail.com',
                'phone' => $this->memberData['phone'],
            ],
        ];
    
        $this->snapToken = Snap::getSnapToken($params);
    
        session(['midtrans_order_id' => $orderId]);
    
        $this->dispatch('snap-token-generated', snapToken: $this->snapToken);
    }

    public function render()
    {
        return view('livewire.midtrans-payment');
    }
}
