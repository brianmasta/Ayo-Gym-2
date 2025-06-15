<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Snap;

class MemberConfirmation extends Component
{
    protected $listeners = ['midtransSuccess'];
    public $member;
    public $membershipPlan;

    public $member_id, $memberCode, $name, $phone, $birthdate, $gender, $join_date, $address, $email, $status, $start_date, $end_date;

    public $membership_plan_id, $method, $bayar, $memberplan_price;

    public $amount, $pembayar_manual;

    // public $member_code;

    public function mount()
    {
        $this->membershipPlan = MembershipPlan::all();
        $this->member = session('member_data');

        // Ambil dari session
        $this->method = $this->member['method'] ?? '';
        $this->pembayar_manual = $this->member['pembayar_manual'] ?? '';

        if (!$this->member) {
            return redirect()->to('/member-form');
        }
    }

    public function simpan()
    {
        $data = session('member_data') ?? [];

        session()->put('member_data', array_merge($data, ['method' => $this->method]));
        $data = session('member_data');
    
        if ($this->method === 'cash') {
            $member = $this->createMemberAndPayment($data, 'cash');
            session()->forget('member_data');
            $this->dispatch('open-receipt-member', orderId: $member->id);
        } else {
            // Jalur midtrans, trigger Snap
            $this->checkout();
        }
    }

    public function checkout()
    {
        $member = session('member_data');

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid('', true),
                'gross_amount' => (int) $member['amount'] ?? 10000,
            ],
            'customer_details' => [
                'first_name' => $member['name'],
                'email' => $member['email'],
                'phone' => $member['phone'],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $this->dispatch('showSnap', token: $snapToken);
        
    }



    protected function createMemberAndPayment(array $data, string $method, ?array $midtransResult = null): Member
    {
    $plan = MembershipPlan::find($data['membership_plan_id']);

    $member = Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'member_code' => $data['member_code'],
            'join_date' => $data['join_date'],
            'status' => 'active',
            'membership_plan_id' => $data['membership_plan_id'],
            'start_date' => $data['join_date'],
            'end_date' => $data['expire_date'],
        ]);

        Payment::create([
            'member_id' => $member->id,
            'membership_plan_id' => $plan->id,
            'amount' => $plan->price,
            'method' => $method,
            'status' => 'success',
            'payment_date' => now(),
            'member_code' => $member->member_code,
            'order_id' => $midtransResult['order_id'] ?? null,
            'payment_type' => $midtransResult['payment_type'] ?? null,
            'midtrans_transaction_id' => $midtransResult['transaction_id'] ?? null,
            'raw_response' => $midtransResult ? json_encode($midtransResult) : null,
        ]);

        return $member;

    }

    #[On('midtransSuccess')]
    public function handleMidtransSuccess($result)
    {
        $data = session('member_data');
        
        if (!$data) {
            session()->flash('error', 'Data member tidak ditemukan.');
            return redirect()->to('/member-form');
        }
    
        $member = $this->createMemberAndPayment($data, 'midtrans', $result);
        session()->forget('member_data');
    
        // Redirect ke receipt page
        return redirect()->route('receipt-member', $member->id);
    }

    public function render()
    {
        return view('livewire.member-confirmation');
    }
}
