<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Cart;
use App\Models\Category;

class ShopComponent extends Component

{
    use WithPagination;
    public $pageSize=12;
    public $orderBy="Default Sorting";

    public $min_value=0;
    public $max_value=1000;

    public function store($product_id,$product_name,$product_price){

        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in cart successfully !!!');
        return redirect()->route('shop.cart');
    }

    public function changePageSize($size){
        $this->pageSize=$size;
    }

    public function changeOrderBy($order){
        $this->orderBy=$order;

    }

    public function addToWishlist($product_id,$product_name,$product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->dispatch('refreshComponent','');
        //$this->emitTo('wishlist-icon-component','refreshComponent');
    }

    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id==$product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->dispatch('refreshComponent','');
                //$this->emit('refreshComponent');
                return;
            }
        }
    }



    public function render()
    {
        if ($this->orderBy=='Price: Low to High')
        {
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy=='price: High to Low')
        {
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy=='Sort By Newness')
        {
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else
        {
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->paginate($this->pageSize);
        }

        $categories=Category::orderBy('name','ASC')->get();
        //$products=Product::paginate($this->pageSize);
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories]);
    }
}
