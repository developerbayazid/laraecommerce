<x-admin.main>
    <div class="container-fluid">
        @if (session('delete-category'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('delete-category')}}</strong>
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Total($)</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ Str::limit($order->email, 15) }}</td>
                        <td>{{ Str::limit($order->address, 15) }}</td>
                        <td>{{ $order->city }}</td>
                        <td>{{ $order->zip }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>${{ $order->total }}</td>
                        <td style="{{ $order->status === 'pending' ? 'color: #21DDFF' : '' }}">{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('order.view', $order->id) }}" class="btn btn-success">View</a>
                            <a href="" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin.main>
