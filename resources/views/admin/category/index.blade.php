@extends('admin.main')

@section('add-category')
    <div class="container-fluid">
        @if(session('category-message'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('category-message')}}</strong>
            </div>
        @endif

        @error('category')
            <div class="alert alert-danger" role="alert">
                <strong>{{$message}}</strong>
            </div>
        @enderror

        <form action={{ route('admin.category.store') }} method="POST">
            @csrf
            <input type="text" name="category" id="" placeholder="Category name"><br><br>
            <button class="bg-white pt-2 pb-2 px-5" type="submit">Add Category</button>
        </form>
    </div>
@endsection
