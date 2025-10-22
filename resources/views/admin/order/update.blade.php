<x-admin.main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Order</h4>
          </div>

          <div class="card-body">
            @if (session('order-update'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('order-update')}}</strong>
                </div>
            @endif

            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
              <!-- Order Info -->
              <div class="mb-3">
                <p><strong>Order Id:</strong> #{{ $order->id }}</p>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $order->first_name }}">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $order->last_name }}">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $order->email }}">
              </div>

              <!-- Order Status -->
              <div class="mb-3">
                <label for="status" class="form-label fw-bold">Order Status</label>
                <select class="form-select" name="status" id="status">
                  <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                  <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                  <option value="payment_pending" {{ $order->status === 'payment_pending' ? 'selected' : '' }}>Payment Pending</option>
                  <option value="payment_received" {{ $order->status === 'payment_received' ? 'selected' : '' }}>Payment Received</option>
                  <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                  <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                  <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                  <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
              </div>

              <!-- Payment Method -->
              <div class="mb-3">
                <p>Payment Method: {{ $order->payment_method }}</p>
              </div>

              <!-- Shipping Address -->
              <div class="mb-3">
                <label for="address" class="form-label fw-bold">Shipping Address</label>
                <textarea class="form-control" name="address" id="address" rows="3">{{ $order->address }}</textarea>
              </div>

              <!-- Total Amount -->
              <div class="mb-3">
                <label class="form-label fw-bold">Total Amount($)</label>
                <input type="text" class="form-control" name="total" value="{{ $order->total }}">
              </div>

              <!-- Action Buttons -->
              <div class="d-flex justify-content-between">
                <a href="{{ route('order.index') }}" class="btn btn-secondary">Back to Orders</a>
                <button type="submit" class="btn btn-primary">Update Order</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Order Summary Card -->
        <div class="card mt-4 border-0 shadow-sm">
          <div class="card-header bg-white fw-bold">
            Ordered Items
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table align-middle">
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
                            <td>{{ $item->product->product_title }}</td>
                            <td>{{ $item->product->product_quantity }}</td>
                            <td>${{ $item->product->product_price }}</td>
                        </tr>
                  @endforeach
                </tbody>
                <tfoot class="table-light">
                  <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th>${{ $order->total }}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-admin.main>
