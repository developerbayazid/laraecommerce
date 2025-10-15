@extends('admin.main')


@section('view-category')
    <div class="container-fluid">
        @if (session('delete-category'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('delete-category')}}</strong>
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category )
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category }}</td>
                        <td>
                            <a href={{ route('admin.category.destroy', $category->id) }} class="btn btn-danger">Delete</a>
                            <a href="" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
