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
              <input class="form-check-input" type="radio" name="payment_method" value="stripe" id="stripe" checked>
              <label class="form-check-label" for="stripe">Credit / Debit Card (Stripe)</label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod">
              <label class="form-check-label" for="cod">Cash on Delivery</label>
            </div>

            <!-- Stripe Payment Section -->
            <div id="stripe-section" class="card border-0 shadow-lg mt-4">
                <div class="card-header bg-primary bg-gradient text-white">
                    <h5 class="mb-0">
                    <i class="bi bi-shield-lock me-2"></i> Secure Credit / Debit Card Payment
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-circle me-2 text-primary"></i> Name on Card
                        </label>
                        <input type="text" id="card-name" class="form-control form-control-lg" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-credit-card-2-front me-2 text-primary"></i> Card Details
                        </label>
                        <div id="card-element" class="border p-3 rounded bg-light shadow-sm"></div>
                        <div id="card-errors" class="text-danger mt-2 small"></div>
                    </div>
                    <div class="text-center border-top pt-3 mt-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" height="25" class="mx-1">
                        <img src="https://cdn.brandfetch.io/stripe.com/w/600/h/200/theme/dark/logo.svg" height="30" class="mx-1">
                        <p class="text-muted mt-2 small">Your payment is encrypted and processed securely via Stripe.</p>
                    </div>
                </div>
            </div>

            <input type="hidden" name="stripeToken" id="stripeToken">


            @foreach ($carts as $cart)
                <input type="hidden" name="items[]" value="{{ $cart }}">
            @endforeach

            <input type="hidden" name="total" value="{{ $subtotal + 10 }}">
            <hr>
            <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mt-3">Order Now(${{ $subtotal + 10 }})</button>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create("card", { hidePostalCode: true });
    cardElement.mount("#card-element");

    const form = document.getElementById("checkout-form");
    const cardErrors = document.getElementById("card-errors");
    const submitButton = form.querySelector('button[type="submit"]');
    const stripeSection = document.getElementById("stripe-section");

    // Hide stripe section by default (only show if stripe selected)
    // Hide stripe section by default
    stripeSection.style.display = "none";

    // Watch for payment method change
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener("change", (e) => {
            if (e.target.value === "stripe") {
                stripeSection.style.display = "block";
            } else {
                stripeSection.style.display = "none";
            }
        });
    });

    form.addEventListener("submit", async (e) => {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;

        // ✅ Only stop submission if payment is Stripe
        if (selectedPayment === "stripe") {
            e.preventDefault();
            submitButton.disabled = true;
            submitButton.innerHTML = "Processing...";

            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                cardErrors.textContent = error.message;
                submitButton.disabled = false;
                submitButton.innerHTML = "Order Now";
                return;
            }

            document.getElementById("stripeToken").value = token.id;
            form.submit();
        }
        // ⚡ If payment is COD, do nothing — allow form to submit normally
    });
});
</script>



<x-frontend.footer />
