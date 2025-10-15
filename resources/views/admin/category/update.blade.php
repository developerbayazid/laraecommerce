@extends('admin.main')

<base href="/public">

@section('update-category')
    <div class="container-fluid">
        @if(session('update-category'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('update-category')}}</strong>
            </div>
        @endif

        @error('category')
            <div class="alert alert-danger" role="alert">
                <strong>{{$message}}</strong>
            </div>
        @enderror

        <form action={{ route('admin.category.edit', $category->id) }} method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="category" id="" value="{{ old('category', $category->category) }}" placeholder="Category name"><br><br>
            <button class="bg-white pt-2 pb-2 px-5" type="submit">Update Category</button>
        </form>
    </div>
@endsection
