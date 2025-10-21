<base href="/public"/>
<x-admin.main>

    <div class="container-fluid">

        <!-- Order Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                <strong>Order #{{ $order->id }}</strong> <br>
                <small>Placed on: {{ $order->created_at }}</small>
                </div>
                <span class="badge {{ $order->status === 'pending' ? 'bg-warning' : '' }} text-dark">{{ $order->status }}</span>
            </div>

            <div class="card-body">
                <h6 class="mb-3 text-muted">Order Items</h6>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/60" class="rounded me-3" alt="">
                                            <div>
                                                <strong>{{ $item->product->product_title }}</strong><br>
                                                <small class="text-muted">Category: {{ $item->product->product_category }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ $item->product->product_price }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                <h5>Total: <span class="text-primary">${{ $order->total }}</span></h5>
                </div>
            </div>

            <div class="card-footer bg-light text-end">
                <button class="btn btn-outline-secondary btn-sm">Edit Details</button>
                <button class="btn btn-primary btn-sm">Download Invoice</button>
            </div>
        </div>

    <!-- Repeat above card for more orders -->
    </div>



</x-admin.main>
