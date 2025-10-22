<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice #{{ $order->id }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-size: 14px;
    }

    .invoice-container {
      background: #fff;
      padding: 40px;
      margin: 50px auto;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      max-width: 900px;
    }

    .invoice-header {
      border-bottom: 2px solid #0d6efd;
      padding-bottom: 15px;
      margin-bottom: 30px;
    }

    .invoice-header h2 {
      font-weight: bold;
      color: #0d6efd;
    }

    .invoice-details th {
      background-color: #f1f3f5;
    }

    .total-section {
      border-top: 2px solid #dee2e6;
      margin-top: 20px;
      padding-top: 10px;
    }

    .invoice-footer {
      text-align: center;
      margin-top: 40px;
      color: #6c757d;
      font-size: 13px;
    }
  </style>
</head>
<body>

<div class="invoice-container">
  <!-- Header -->
  <div class="invoice-header d-flex justify-content-between align-items-center">
    <div>
      <h2>INVOICE</h2>
      <p class="mb-0"><strong>Invoice #: </strong>{{ $order->id }}</p>
      <p><strong>Date:</strong> {{ $order->created_at }}</p>
    </div>
    <div class="text-end">
      <h4 class="text-primary mb-1">Bayazid Store</h4>
      <p class="mb-0">Block H, Banani 11, Ventura Iconia</p>
      <p class="mb-0">Dhaka, Bangladesh</p>
      <p>Email: bayazid.freelancer@com</p>
    </div>
  </div>

  <!-- Customer Info -->
  <div class="row mb-4">
    <div class="col-md-6">
      <h6 class="text-uppercase text-secondary">Billed To:</h6>
      <p class="mb-0"><strong>{{ $order->first_name }}</strong></p>
      <p class="mb-0">{{ $order->email }}</p>
      <p class="mb-0">{{ $order->phone }}</p>
      <p>{{ $order->address }}</p>
    </div>
    <div class="col-md-6 text-md-end">
      <h6 class="text-uppercase text-secondary">Payment Details:</h6>
      <p class="mb-0"><strong>Method:</strong> {{ $order->payment_method }}</p>
      <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>
  </div>

  <!-- Product Table -->
  <table class="table table-bordered invoice-details align-middle">
    <thead class="table-light">
      <tr>
        <th>ID#</th>
        <th>Product</th>
        <th class="text-center">Qty</th>
        <th class="text-end">Price</th>
        <th class="text-end">Total</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->id }}</td>
                <td>{{ $item->product->product_title }}</td>
                <td class="text-center">{{ $item->product->product_quantity }}</td>
                <td class="text-end">{{ $item->product->product_price }}</td>
                <td class="text-end">{{ $item->product->product_price }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>

  <!-- Summary Section -->
  <div class="row justify-content-end">
    <div class="col-md-5">
      <div class="total-section">
        <table class="table table-borderless">
          <tr>
            <th>Subtotal:</th>
            <td class="text-end">${{ $order->total - 10 }}</td>
          </tr>
          <tr>
            <th>Shipping:</th>
            <td class="text-end">$10.00</td>
          </tr>
          <tr class="table-light">
            <th class="fw-bold">Grand Total:</th>
            <td class="fw-bold text-end text-primary">${{ $order->total }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="invoice-footer">
    <p>Thank you for shopping with us!</p>
    <p>If you have any questions about this invoice, please contact bayazid.freelancer@gmail.com</p>
  </div>
</div>

</body>
</html>
