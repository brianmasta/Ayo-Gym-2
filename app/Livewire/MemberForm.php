<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipPlan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Snap;

class MemberForm extends Component
{
    public $membershipPlan;

    public $name, $phone, $birthdate, $gender, $join_date, $address, $email;

    public $membership_plan_id, $amount, $memberplan_price, $method;

    public $memberCode;

    public function openModal()
    {
        // Modal dihandle Bootstrap, jadi ga perlu logic tambahan
    }


    public function getMembershipPlanDetailsProperty()
    {
        $plan = MembershipPlan::find($this->membership_plan_id);
        return $plan
            ? "{$plan->name} - Rp " . number_format($plan->price, 0, ',', '.') . " ({$plan->duration_days} hari)"
            : '-';
    }


    private function generateMemberCode()
    {
        $number = Member::max('id') ?? 0;
    
        do {
            $number++;
            $code = 'AG' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $code)->exists());
    
        return $code;
    }

    private function calculateExpireDate()
    {
        $plan = MembershipPlan::find($this->membership_plan_id);

        if ($plan) {
            return Carbon::parse($this->join_date)->addDays($plan->duration_days)->format('Y-m-d');
        }

        return null;
    }

    public function confirmSubmit()
    {
        $this->submit(); // jalankan submit()
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone'=> 'required|numeric|unique:members,phone',
            'birthdate'=> 'required|date|before:today',
            'gender'=> 'required|in:L,P',
            'address'=> 'required|string',
            'membership_plan_id'=> 'required|exists:membership_plans,id',
            'join_date'=> 'required|date',
            'method' => 'required|in:cash,midtrans',
        ]);
    
        // Validasi kombinasi nama + email/phone
        $existingMember = Member::where('name', $this->name)
            ->where(function($query) {
                $query->where('email', $this->email)
                    ->orWhere('phone', $this->phone);
            })->first();
    
        if ($existingMember) {
            $this->addError('name', 'Nama dengan email atau no HP ini sudah terdaftar.');
            return;
        }
    
        $this->memberCode = $this->generateMemberCode();
        // $expireDate = $this->calculateExpireDate();
    
        $memberPlan = MembershipPlan::find($this->membership_plan_id);
        $price = $memberPlan->price;
        $duration_days = $memberPlan->duration_days;
    
        // Simpan data ke session untuk kedua metode
        // session([
        //     'member_data' => [
        //         'name' => $this->name,
        //         'email' => $this->email,
        //         'phone' => $this->phone,
        //         'birthdate' => $this->birthdate,
        //         'gender' => $this->gender,
        //         'address' => $this->address,
        //         'member_code' => $this->memberCode,
        //         'membership_plan_id' => $this->membership_plan_id,
        //         'method' => $this->method,
        //         'amount'=> $price,
        //         'join_date'=> $this->join_date,
        //         'expire_date' => $expireDate, 
        //     ]
        // ]);

        $member = Member::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'address' => $this->address,
            'member_code' => $this->memberCode,
            'membership_plan_id' => $this->membership_plan_id,
            'status' => 'active',
            'join_date' => $this->join_date,
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => now()->addDays($duration_days),
        ]);

        // Ambil user yang sedang login
        $userId = auth()->user()->id;

        $order_id = 'CASH-' . now()->timestamp;
    
        // Alur berdasarkan metode pembayaran
        if ($this->method === 'cash') {
            \App\Models\Payment::create([
                'member_id' => $member->id,
                'membership_plan_id' => $this->membership_plan_id,
                'member_code' => $this->memberCode,
                'amount' => $price,
                'method' => 'cash',
                'status' => 'success',
                'order_id' => $order_id,
                'payment_type' => 'cash',
                'payment_date' => now(),
                'transaction_id' => 'CASH-' . now()->timestamp,
                'user_id'=> $userId,
            ]);

            session()->flash('message', 'Pembayaran berhasil dan member telah aktif.');
            $this->resetForm();
        
            $this->dispatch('open-receipt-member', orderId:  $order_id);

        } else {
            $orderId = 'MBR-' . Str::uuid();

            $payload = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $memberPlan->price ?? 1000,
                ],
                'customer_details' => [
                    'first_name' => $member->name,
                    'email' => $member->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($payload);
            

            session([
                'member_id' => $member->id,
                'membership_plan_id' => $memberPlan->id,
                'amount' => $memberPlan->price,
                'order_id' => $orderId,
                'member_code' => $member->member_code,
            ]);

            $this->dispatch('showSnap', token: $snapToken);

        }
        

    }

    #[On('midtransSuccess')]
    public function paymentSuccess($result)
    {
        // dd($result);
        $memberId = session('member_id');
        $membershipPlanId = session('membership_plan_id');
        $amount = session('amount');
        // $orderId = session('order_id');
        $member_code = session('member_code');
        $order_id = $result['order_id'];
        $payment_type = $result['payment_type'];
        $midtrans_transaction_id = $result['transaction_id'];

        
        // Ambil user yang sedang login
        $userId = auth()->user()->id;

        \App\Models\Payment::create([
            'member_id' => $memberId,
            'membership_plan_id' => $membershipPlanId,
            'member_code' => $member_code,
            'amount' => $amount,
            'method' => 'midtrans',
            'status' => 'success',
            'order_id' => $order_id,
            'payment_date' => now(),
            'user_id'=> $userId,
            'transaction_id' => $midtrans_transaction_id, // dari midtrans
            'payment_type' => $payment_type,
            // 'raw_response' => json_encode($result), // Simpan data tambahan dari Midtrans
        ]);

        session()->flash('message', 'Pembayaran berhasil dan member telah aktif.');
        $this->resetForm();
    
        $this->dispatch('open-receipt-member', orderId: $order_id);
    }



    public function mount()
    {

        $this->membershipPlan = MembershipPlan::all();

            // Ambil kembali data jika ada
        if (session()->has('member_data')) {
            $data = session('member_data');
            $this->name = $data['name'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->phone = $data['phone'] ?? '';
            $this->birthdate = $data['birthdate'] ?? '';
            $this->gender = $data['gender'] ?? '';
            $this->address = $data['address'] ?? '';
            $this->membership_plan_id = $data['membership_plan_id'] ?? '';
        }

    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'phone',
            'birthdate',
            'gender',
            'address',
            'membership_plan_id',
        ]);

        session()->forget('member_data'); // hapus juga dari session kalau ada
    }

    public function render()
    {
        return view('livewire.member-form');
    }




}
