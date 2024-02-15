<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Add New Product
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Add New Product
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admin.products')}}" class="btn btn-success float-end">All Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                    
                              
                                <form wire:submit.prevent="addProduct">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-lable">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter product name" wire:model="name" wire:keyup="generateSlug">
                                        @error('name')
                                         <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-lable">Slug</label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter product slug" wire:model="slug">
                                        @error('slug')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>


                                    <div class="mb-3 mt-3">
                                        <label for="short_description" class="form-lable">Short Description</label>
                                        <textarea class="form-control" name="short_description" placeholder="Enter Short Description" wire:model="short_description"></textarea>
                                        @error('short_description')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                                    
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-lable">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter Description" wire:model="description"></textarea>
                                        @error('description')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-lable">Regular_Price</label>
                                        <input type="text" name="sale_price" class="form-control" placeholder="Enter regular price" wire:model="regular_price">
                                        @error('regular_price')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sale_price" class="form-lable">Sale_Price</label>
                                        <input type="text" name="sale_price" class="form-control" placeholder="Enter sale price" wire:model="sale_price">
                                        @error('sale_price')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="sku" class="form-lable">SKU</label>
                                        <input type="text" name="sku" class="form-control" placeholder="Enter sku" wire:model="sku">
                                        @error('sku')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="stock_status" class="form-lable" wire:model="stock_status">Stock Status</label>
                                        <select class="form-control">
                                            <option value="instock">Instock</option>
                                            <option value="outofstock">Out Of Stock</option>
                                        </select>
                                        @error('stock_status')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="featured" class="form-lable" wire:model="featured">Featured</label>
                                        <select class="form-control" name="featured">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        @error('featured')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="quantity" class="form-lable">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" placeholder="Enter product quantity" wire:model="quantity">
                                        @error('quantity')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-lable">Image</label>
                                        <input type="file" class="form-control" name="image" wire:model="image"/>
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}" width="120" />
                                        @endif
                                        @error('image')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="category_id" class="form-lable">Category</label>
                                        <select class="form-control" name="category_id" wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

