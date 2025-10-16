@extends('admin.main')
<base href="/public">

@section('update-product')

    <div class="container py-5">
        @if(session('update-product'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('update-product')}}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </strong>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0 text-secondary">Update Product</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{ $product->product_title }}" placeholder="Enter product name">
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category">
                            <option value="" selected disabled>Select category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}" {{ $category->category === $product->product_category ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach


                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price($)</label>
                        <input type="number" class="form-control" id="productPrice" name="price" value="{{ $product->product_price }}" placeholder="Enter price">
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity" value="{{ $product->product_quantity }}" placeholder="Enter quantity">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4" placeholder="Enter product description">{{ $product->product_description }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <div class="mb-3 mt-1">
                            <img width="100px" height="100px" src="{{ asset('products/' . $product->product_image) }}" alt="">
                        </div>
                        <input class="form-control" type="file" id="productImage" value="{{ $product->product_image }}" name="image" accept="image/*">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
