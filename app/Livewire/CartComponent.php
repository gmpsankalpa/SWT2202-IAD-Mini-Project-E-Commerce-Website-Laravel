<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\CartIconComponent;
Use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId){
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty+1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->dispatch('refreshComponent','');
        //$this->emitTo('cart-icon-component','refreshComponent','');
    }

    public function decreaseQuantity($rowId){
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty-1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->dispatch('refreshComponent','');
        //$this->emitTo('cart-icon-component','refreshComponent');
    }

    public function destroy($id){
        Cart::instance('cart')->remove($id);
        session()->flash('success_message','Item has been removed');
        $this->dispatch('refreshComponent','');
        //$this->emitTo('cart-icon-component','refreshComponent');
    }

    public function clearAll(){
        Cart::instance('cart')->destroy();
        $this->dispatch('refreshComponent','');
       // $this->emitTo('cart-icon-component','refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
