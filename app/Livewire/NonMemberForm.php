<?php

namespace App\Livewire;

use App\Models\MembershipPlan;
use App\Models\NonMember;
use App\Models\Payment;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Snap;


class NonMemberForm extends Component
{
    public $membershipPlan, $id_non_member, $event;
    public $membership_plan_id, $name, $phone, $visit_purpose, $method;

    public function mount()
    {
        $this->membershipPlan = MembershipPlan::all();

    }

    public function submit()
    {
        $plan = MembershipPlan::find($this->membership_plan_id);

        // Ambil user yang sedang login
        $userId = auth()->user()->id;

        $nonMember = NonMember::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'visit_purpose'=> $this->visit_purpose,
        ]);

        $plan = MembershipPlan::find($this->membership_plan_id);
        
        $order_id = 'CASH-' . now()->timestamp;

        if ($this->method === 'cash') {
            Payment::create([
                'non_member_id' => $nonMember->id,
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'method' => 'cash',
                'status' => 'success',
                'order_id' => $order_id,
                'payment_type' => 'cash',
                'payment_date' => now(),
                'transaction_id' => 'CASH-' . now()->timestamp,
                'user_id'=> $userId,
            ]);

            session()->forget(['non_member_id', 'membership_plan_id', 'amount', 'order_id']);
    
            $this->dispatch('open-receipt', orderId: $nonMember->id);
        } else {
            $orderId = 'NON-' . Str::uuid();

            $payload = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $plan->price ?? 1000,
                ],
                'customer_details' => [
                    'first_name' => $nonMember->name,
                    // 'email' => 'brianmasta@gmail.com',
                ],
            ];


            $snapToken = Snap::getSnapToken($payload);


            session([
                'non_member_id' => $nonMember->id,
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'order_id' => $orderId,
            ]);

            $this->dispatch('showSnap', token: $snapToken);
        }


    }

    #[On('midtransSuccess')]
    public function handleMidtransSuccess($result)
    {
        // Ambil user yang sedang login
        $userId = auth()->user()->id;

        $nonMemberId = session('non_member_id');
        $membershipPlanId = session('membership_plan_id');
        $amount = session('amount');
        $orderId = session('order_id');
    
        // Simpan data ke tabel payment
        Payment::create([
            'non_member_id' => $nonMemberId,
            'membership_plan_id' => $membershipPlanId,
            'amount' => $amount,
            'method' => 'midtrans',
            'status' => 'success',
            'order_id' => $orderId,
            'transaction_id' => $result['transaction_id'], // dari midtrans
            'payment_type' => $result['payment_type'],
            'user_id'=> $userId,
            // 'paid_at' => now(),
        ]);

        session()->forget(['non_member_id', 'membership_plan_id', 'amount', 'order_id']);
    
        $this->dispatch('open-receipt', orderId: $nonMemberId);

    }

    public function render()
    {
        return view('livewire.non-member-form', [
            'membershipPlans' => MembershipPlan::all(),
        ]);
    }
}
