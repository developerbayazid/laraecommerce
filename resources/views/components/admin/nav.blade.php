<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          {{-- <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div> --}}
          <div class="title">
            <h1 class="h5">Bayazid Hasan</h1>
            <p>Admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
            <li class="{{ request()->path() === 'dashboard' ? 'active' : '' }}">
                <a href={{ route('dashboard') }}>
                    <i class="icon-home"></i>Home
                </a>
            </li>
            <li class="{{ request()->is('category*') || request()->is('categories*') ? 'active' : '' }}">
                <a href="#category" aria-expanded="false" data-toggle="collapse">
                    <i class="icon-windows"></i>Categories
                </a>
                <ul id="category" class="collapse list-unstyled ">
                    <li>
                        <a href={{ route('admin.category.add') }}>Add Category</a>
                    </li>
                    <li>
                        <a href={{ route('admin.category.view') }}>View Category</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('product*') ? 'active' : '' }}">
                <a href="#product" aria-expanded="false" data-toggle="collapse">
                    <i class="icon-windows"></i>Products
                </a>
                <ul id="product" class="collapse list-unstyled ">
                    <li>
                        <a href={{ route('admin.product.add') }}>Add Product</a>
                    </li>
                    <li>
                        <a href={{ route('admin.product.view') }}>View Product</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('order*') ? 'active' : '' }}">
                <a href="#order" aria-expanded="false" data-toggle="collapse">
                    <i class="icon-windows"></i>Orders
                </a>
                <ul id="order" class="collapse list-unstyled ">
                    <li>
                        <a href={{ route('order.index') }}>View Order</a>
                    </li>
                </ul>
            </li>

        </ul>
      </nav>
