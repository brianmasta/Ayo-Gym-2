<?php

namespace App\Livewire;

use App\Models\MembershipPlan as ModelsMembershipPlan;
use Livewire\Component;

class MembershipPlan extends Component
{
    public $selectedPlanId;

    public function delete($id)
    {
        ModelsMembershipPlan::findOrFail($id)->delete();
        session()->flash('message', 'Paket berhasil dihapus.');
    }

    public function selectForEdit($id)
    {
        $this->selectedPlanId = $id;
    }

    public function render()
    {
        return view('livewire.membership-plan', [
            'plans' => ModelsMembershipPlan::latest()->get(),
        ]);
    }
}
