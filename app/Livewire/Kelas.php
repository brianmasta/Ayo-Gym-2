<?php

namespace App\Livewire;

use App\Models\Kelass;
use Livewire\Component;

use Livewire\WithPagination;

class Kelas extends Component
{

    use WithPagination;
    public $search;

    protected $paginationTheme = 'Bootstrap';
    
    public function render()
    {
        return view('livewire.kelas', [
            'posts' => Kelass::where('name', 'LIKE', '%'.$this->search.'%')->paginate(10),
        ]);
    }
}
