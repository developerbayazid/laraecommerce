@extends('admin.main')


@section('view-product')
    <div class="container-fluid">
        @if (session('delete-product'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('delete-product')}}</strong>
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Tittle</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Product Price($)</th>
                    <th scope="col">Product Quantity(pcs)</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product )
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_title }}</td>
                        <td>{{ $product->product_category }}</td>
                        <td>{{ Str::limit($product->product_description, 20, '...') }}</td>
                        <td>${{ $product->product_price }}</td>
                        <td>{{ $product->product_quantity }} pcs</td>
                        <td>
                            <img width="50px" height="50px" src="{{ asset('products/'.$product->product_image) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('admin.product.destroy', $product->id) }}" class="btn btn-danger">Delete</a>
                            <a href="" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <div class="mb-3">
                {{ $products->links() }}
            </div>
        </table>
    </div>
@endsection
