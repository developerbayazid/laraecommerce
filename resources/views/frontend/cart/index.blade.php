<x-frontend.header :cartCount="$cartCount"/>
  <!-- Cart Section -->
  <div class="container my-5">
    <div class="row py-5">
      <!-- Cart Items -->
      <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
             @if(session('product-remove'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('product-remove')}}</strong>
                </div>
            @endif
            <h5 class="card-title mb-4">Cart Items ({{ $carts ? $carts->count() : '0' }})</h5>

            @php
                $subtotal = 0;
            @endphp

            <!-- Cart Item 1 -->
            @foreach ($carts as $cart)
                @php
                    $subtotal = $cart->product->product_price + $subtotal
                @endphp
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <img width="50px" height="50px" src="{{ asset('products/'. $cart->product->product_image) }}" alt="Product" class="rounded me-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">
                            <a href="{{ route('frontend.product.single', $cart->product->id) }}">{{ $cart->product->product_title }}</a>
                        </h6>
                        <p class="mb-0 text-muted small">Category: {{ $cart->product->product_category }}</p>
                    </div>
                    <div class="text-end">
                        <p class="mb-1 fw-bold">${{ $cart->product->product_price }}</p>
                        <div class="d-flex align-items-center justify-content-end">
                            <input type="number" min="1" value="1" class="form-control form-control-sm w-25 me-2 text-center">
                            <a href="{{ route('cart.destroy', $cart->id) }}" class="btn btn-outline-danger btn-sm">Remove</a>
                        </div>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Summary Section -->
      <div class="col-lg-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title mb-4">Order Summary</h5>

            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal</span>
              <span>${{ $subtotal }}</span>
            </div>

            <div class="d-flex justify-content-between mb-2">
              <span>Shipping</span>
              <span>$10.00</span>
            </div>

            <div class="d-flex justify-content-between mb-3 border-top pt-2 fw-bold">
              <span>Total</span>
              <span>${{ $subtotal + 10 }}</span>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 mb-2">Proceed to Checkout</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-outline-secondary w-100">Continue Shopping</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-frontend.footer />
