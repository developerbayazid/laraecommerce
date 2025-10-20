<x-frontend.header :cartCount="$cartCount"/>



<div class="container py-5">
  <form action="{{ route('order.store') }}" method="POST">
    @csrf

    <div class="row g-4">

      <!-- Billing Details -->
      <div class="col-lg-7">
        <div class="card shadow-sm">
            @if(session('order-successful'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('order-successful')}}</strong>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p><strong>{{ $error }}</strong></p>
                    @endforeach
                </div>
            @endif
          <div class="card-header">
            <h4 class="mb-0 text-primary">Shipping Information</h4>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="John" value="{{ old('first_name') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ old('last_name') }}">
              </div>
              <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}">
              </div>
              <div class="col-12">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="+880 1234 567890" value="{{ old('phone') }}">
              </div>
              <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="123 Main Street" value="{{ old('address') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" placeholder="Dhaka" value="{{ old('city') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Zip Code</label>
                <input type="text" name="zip" class="form-control" placeholder="1207" value="{{ old('zip') }}">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="col-lg-5">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4 class="mb-0 text-primary">Your Order</h4>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                @php
                    $subtotal = 0;
                @endphp

                @foreach ($carts as $cart)
                    @php
                        $subtotal = $cart->product->product_price + $subtotal
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $cart->product->product_title }}
                    <span>${{ $cart->product->product_price }}</span>
                </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Subtotal
                    <span>${{ $subtotal }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Shipping
                    <span>$10.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center text-success fw-bold">
                    Total
                    <span>${{ $subtotal + 10 }}</span>
                </li>
            </ul>

            <h6 class="fw-bold mb-3">Select Payment Method</h6>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="card" id="card" checked>
              <label class="form-check-label" for="card">Credit / Debit Card</label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod">
              <label class="form-check-label" for="cod">Cash on Delivery</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="payment_method" value="bkash" id="bkash">
              <label class="form-check-label" for="bkash">bKash / Nagad</label>
            </div>

            @foreach ($carts as $cart)
                <input type="hidden" name="items[]" value="{{ $cart }}">
            @endforeach

            <input type="hidden" name="total" value="{{ $subtotal + 10 }}">
            <hr>
            <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mt-3">Order Now</button>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>


<x-frontend.footer />
