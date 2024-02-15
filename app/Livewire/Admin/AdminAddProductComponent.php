<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $description;
    public $short_description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status = 'instock';
    public $featured = 0;
    public $quantity;
    public $image;
    public $category_id;

    public function generateSlug(){
        $this->slug=Str::slug($this->name);
    }

    public function addProduct(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required',
            'short_description'=>'required',
            'regular_price'=>'required',
            'sale_price'=>'required',
            'sku'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ]);
    
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        
        // Use the original name of the uploaded image
        $imageName = $this->image->getClientOriginalName();
    
        // Store the image with the original name
        $this->image->storeAs('products', $imageName);
        
        $product->image = $imageName;
        $product->category_id = $this->category_id;
        $product->save();
    
        session()->flash('message', 'Product has been added!');
    }

    public function render()
    {
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories]);
    }
}
