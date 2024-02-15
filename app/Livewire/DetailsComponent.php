<?php

namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug){
        $this->slug =$slug;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in cart');
        return redirect()->route('shop.cart');
    }
    public function render()
    {
        $product=Product::where('slug',$this->slug)->first();
        $rproducts=Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts=product::Latest()->take(4)->get();
        return view('livewire.details-component',['product'=>$product,'rproducts'=>$rproducts,'nproducts'=>$nproducts]);
    }
}
