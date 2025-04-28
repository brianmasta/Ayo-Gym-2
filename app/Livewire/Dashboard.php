<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\NonMember;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $jumlahMember;

    public $jumlahNonMember;

    public $labels = [];
    public $data = [];

    public function mount()
    {
        $this->jumlahMember = Member::count();
        $this->jumlahNonMember = NonMember::count();

        $weeks = collect();

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);
            $endOfWeek = Carbon::now()->startOfWeek()->subWeeks($i)->endOfWeek();
    
            $weeks->push([
                'label' => $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M'),
                'start' => $startOfWeek,
                'end' => $endOfWeek,
            ]);
        }
    
        $this->labels = $weeks->pluck('label');
    
        $this->data = $weeks->map(function ($week) {
            return Member::whereBetween('created_at', [$week['start'], $week['end']])->count();
        });
    }

    public function render()
    {
        return view('dashboard');
    }
}
