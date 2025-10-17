<x-admin.header />
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <x-admin.nav />
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">

          {{ $slot }}

        </section>

        <!-- End of Sections -->
<x-admin.footer />
