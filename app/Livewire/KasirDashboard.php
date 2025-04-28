<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Snap;

class KasirDashboard extends Component
{
    public $search, $selectedMember;
    public $membership_plan_id, $method;
    public $plans;

    public function mount()
    {
        $this->plans = MembershipPlan::all();
    }

    public function searchMember()
    {
        $this->selectedMember = Member::where('name', 'like', "%{$this->search}%")
        ->orWhere('member_code', $this->search)
        ->first();

    if (!$this->selectedMember) {
        session()->flash('message', 'Member tidak ditemukan.');
    }

    }

    public function updatedSearch()
    {
        $this->searchMember();
    }

    public function proceed()
    {
        $plan = MembershipPlan::find($this->membership_plan_id);

        // Proses pembayaran
        if ($this->method === 'cash') {
            Payment::create([
                'member_code' => $this->selectedMember->member_code,
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'method' => 'cash',
                'status' => 'success',
            ]);

            // Perpanjang expired_at
            $this->selectedMember->update([
                'membership_plan_id' => $plan->id,
                'end_date' => now()->addDays($plan->duration_days),
                'status' => 'active',
            ]);

            session()->flash('message', 'Paket berhasil diperpanjang.');
            $this->dispatch('close-modal'); // bisa untuk nutup modal via JS
        } else {
            // Midtrans
            $orderId = 'MEMBER-' . Str::uuid();
    
            $payload = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $plan->price,
                ],
                'customer_details' => [
                    'first_name' => $this->selectedMember->name,
                    'email' => $this->selectedMember->email ?? 'dummy@email.com',
                ],
            ];
    
            $snapToken = Snap::getSnapToken($payload);
    
            session([
                'member_id' => $this->selectedMember->id,
                'member_code' => $this->selectedMember->member_code,
                'membership_plan_id' => $plan->id,
                'amount' => $plan->price,
                'order_id' => $orderId,
            ]);
    
            $this->dispatch('showSnap', token: $snapToken);
        }

        // Kalau Midtrans, tinggal generate SnapToken dan dispatch ke JS
    }

    #[On('qrScanned')]
    public function handleQrScanned($data)
    {

        $this->search = $data['memberId'];
        $this->updatedSearch(); // memanggil logika pencarian manual
    }

    #[On('midtransSuccess')]
    public function handleMidtransSuccess($result)
    {

        $memberId = session('member_id');
        $membershipPlanId = session('membership_plan_id');
        $amount = session('amount');
        $member_code = session('member_code');

        // $orderId = session('order_id');


        $plan = MembershipPlan::find($membershipPlanId);

        Payment::create([
            'member_code' => $member_code,
            'membership_plan_id' => $membershipPlanId,
            'amount' => $amount,
            'method' => 'online',
            'status' => 'success',
            // 'order_id' => $orderId,
        ]);

        Member::find($memberId)->update([
            'membership_plan_id' => $membershipPlanId,
            'end_date' => now()->addDays($plan->duration_days),
        ]);

        session()->forget(['member_code', 'membership_plan_id', 'amount']);

        session()->flash('message', 'Pembayaran berhasil via Midtrans.');
        $this->dispatch('hidden.bs.modal');
    }

    public function render()
    {
        return view('livewire.kasir-dashboard');
    }
}
