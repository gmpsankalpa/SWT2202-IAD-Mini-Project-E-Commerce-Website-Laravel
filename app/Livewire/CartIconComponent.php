<?php

namespace App\Livewire;

use Livewire\Component;

class CartIconComponent extends Component
{
    protected $listeners=['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.cart-icon-component');
    }
}
