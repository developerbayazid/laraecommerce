<base href="/public">
<x-frontend.header />
  <!-- Product Section -->
  <div class="container py-5">
    <div class="row py-5">

      <!-- Product Images -->
      <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm">
          <img src="{{ asset('products/' . $product->product_image) }}" class="card-img-top" alt="Main Product Image">
        </div>
        <div class="d-flex gap-2 mt-3">
          <img src="{{ asset('products/' . $product->product_image) }}" class="img-thumbnail" alt="Thumb 1">
          <img src="{{ asset('products/' . $product->product_image) }}" class="img-thumbnail" alt="Thumb 2">
          <img src="{{ asset('products/' . $product->product_image) }}" class="img-thumbnail" alt="Thumb 3">
        </div>
      </div>

      <!-- Product Details -->
      <div class="col-md-6">
        <h2 class="product-title">{{ $product->product_title }}</h2>
        <div class="rating mb-2">
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-half"></i>
          <i class="bi bi-star"></i>
          <span class="text-muted text-warning">(125 reviews)</span>
        </div>
        <h4 class="price mb-3">${{ $product->product_price }}</h4>

        <p class="text-muted">{{ Str::limit($product->product_description, 100, '...') }}</p>

        <form class="mt-4">
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" id="quantity" class="form-control w-25" min="1" value="1">
          </div>
          <button type="submit" class="btn btn-primary px-4 me-2">Add to Cart</button>
          <button type="button" class="btn btn-outline-secondary px-4">Buy Now</button>
        </form>

        <hr class="my-4">
        <ul class="list-unstyled">
          <li><strong>Category:</strong> {{ $product->product_category }}</li>
          <li><strong>Availability:</strong> In Stock</li>
          <li><strong>SKU:</strong> HDX-2025</li>
        </ul>
      </div>
    </div>

    <!-- Product Tabs -->
    <div class="row mt-5">
      <div class="col-md-12">
        <ul class="nav nav-tabs" id="productTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">Description</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Reviews (3)</button>
          </li>
        </ul>

        <div class="tab-content p-4 border border-top-0 bg-white shadow-sm" id="productTabContent">
          <!-- Description Tab -->
          <div class="tab-pane fade show active" id="description" role="tabpanel">
            <h5>Full Product Description</h5>
            <p>
                {{ $product->product_description }}
            </p>
          </div>

          <!-- Reviews Tab -->
          <div class="tab-pane fade" id="reviews" role="tabpanel">
            <h5>Customer Reviews</h5>

            <div class="border-bottom pb-3 mb-3">
              <strong>John Doe</strong> <span class="text-warning">★★★★☆</span>
              <p>Great sound quality and battery life! Very comfortable to wear for long hours.</p>
            </div>

            <div class="border-bottom pb-3 mb-3">
              <strong>Jane Smith</strong> <span class="text-warning">★★★★★</span>
              <p>Noise cancellation works amazingly well! Totally worth the price.</p>
            </div>

            <div>
              <strong>Write a Review</strong>
              <form class="mt-3">
                <div class="mb-3">
                  <label for="reviewText" class="form-label">Your Review</label>
                  <textarea id="reviewText" class="form-control" rows="3" placeholder="Share your thoughts..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit Review</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Latest Products -->
    <div class="container shop_section layout_padding">
        <div class="mt-5">
        <h4 class="mb-4">Latest Products</h4>
        <div class="row">
            @foreach ($products as $product)

                <div class="col-sm-6 col-md-4 col-lg-3">

                    <div class="box">
                        <a href="{{ route('frontend.product.single', $product->id) }}">
                        <div class="img-box">
                            <img src="{{ asset('products/' . $product->product_image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                            {{ $product->product_title }}
                            </h6>
                            <h6>
                            Price
                            <span>
                                ${{ $product->product_price }}
                            </span>
                            </h6>
                        </div>
                        <div class="new">
                            <span>
                            New
                            </span>
                        </div>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
        </div>
    </div>

  </div>

<x-frontend.footer />
