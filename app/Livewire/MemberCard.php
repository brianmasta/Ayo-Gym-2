<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberCard extends Component
{
    public $member;

    public function mount($id)
    {
        $this->member = Member::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.member-card');
    }
}
