<nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            Goriber Bazar
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop') }}">
                Shop
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="why.html">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="testimonial.html">
                Testimonial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">
            @if (Auth::check())
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Dashboard
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Login
                    </span>
                    </a>
                    <a href="{{ route('register') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Register
                    </span>
                </a>
            @endif
            <a href="{{ route('cart.index') }}">
              <i class="fa fa-shopping-bag" aria-hidden="true">
                <strong>
                    ({{ $cartCount ?? '0' }})
                </strong>
              </i>
            </a>
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
