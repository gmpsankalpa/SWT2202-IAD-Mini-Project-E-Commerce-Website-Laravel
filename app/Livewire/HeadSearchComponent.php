<?php

namespace App\Livewire;

use Livewire\Component;

class HeadSearchComponent extends Component
{
    public $q;

    public function mount(){
        $this->fill(request()->only('q'));
    }
    public function render()
    {
        return view('livewire.head-search-component');
    }
}
