<?php

namespace App\Livewire;

use App\Models\Member;
use Carbon\Carbon;
use Livewire\Component;

class ScanMember extends Component
{
    public $scannedId;
    public $member;

    public function updatedScannedId($value)
    {
        // logger("Scanned ID: " . $value);
        $this->member = Member::where('member_code', $value)->first();
        // dd($this->member);
    }

    public function getSisaHariProperty()
    {
        if (!$this->member || !$this->member->end_date){
            return null;
        }

        $expired = Carbon::parse($this->member->end_date);
        $today = Carbon::today();

        return $today->diffInDays($expired, false); // false biar bisa dapat nilai negatif jika sudah kadaluarsa
    }

    public function scanUlang()
    {
        $this->reset(['scannedId', 'member']);
        $this->dispatch('scan-again'); // Untuk hidupkan kembali kamera dari JS
    }

    public function render()
    {
        return view('livewire.scan-member');
    }
}
