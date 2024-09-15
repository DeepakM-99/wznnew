<style>
  .sidebar.os-host.os-theme-light.os-host-overflow.os-host-overflow-y.os-host-resize-disabled.os-host-scrollbar-horizontal-hidden.os-host-transition {
    background: #000000f5;
  }
  a.brand-link {
    background: #000000f5;
  }
  .main-sidebar.sidebar-dark-primary.elevation-4 {background-color:black;}
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
          @php
            $data = session()->get('adminData');
          @endphp

      @if($data && $data[0]->type == 1)
      <span class="brand-text font-weight-light">WZN HEALTHY FOOD
</span>
      @else
      <span class="brand-text font-weight-light">WZN HEALTHY FOOD
</span>
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        @if($data && $data[0]->type == 1)
          <a href="{{ url('/admin/dashboard') }}" class="d-block">Super-Admin</a>
        @else
          <a href="{{ url('/admin/dashboard') }}" class="d-block">Admin</a>
        @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a style="background-color: #00ff7ca1;" href=""{{ url('/admin/dashboard') }}"" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>            
          </li>          

          <li class="nav-header">Navigation</li>  
       <li class="nav-item has-treeview menu-open">
  <a href="{{ url('admin/order-list') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
    <i class="nav-icon fas fa-shopping-cart"></i>
    <p>
      Orders
    </p>
  </a>            
</li>        
<li class="nav-item has-treeview" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cogs"></i>
    <p>
      Master
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('admin/menu-category') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="far fa-list-alt nav-icon"></i>
        <p>Food Menu Category</p>
      </a>
    </li>              
    <li class="nav-item">
      <a href="{{ url('admin/food-menu') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-utensils nav-icon"></i>
        <p>Food Menu</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('admin/allergy') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-allergies nav-icon"></i>
        <p>Allergy/Dislikes</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('admin/inventory') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-boxes nav-icon"></i>
        <p>Inventory</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('admin/coupon') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-ticket-alt nav-icon"></i>
        <p>Coupon</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('admin/delivery-location') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-map-marker-alt nav-icon"></i>
        <p>Delivery Locations</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('admin/meal-plan') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-calendar-alt nav-icon"></i>
        <p>Membership Plan</p>
      </a>
    </li>
  </ul>
</li>
@if($data && $data[0]->type == 1)
<li class="nav-item" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px; margin-top:3px;">
  <a href="{{ url('admin/create-admin') }}" class="nav-link">
    <i class="nav-icon fas fa-user-shield"></i>
    <p>Admin List</p>
  </a>
</li>
<li class="nav-item has-treeview" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px; margin-top:3px;">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Users
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('admin/user-detail') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-user-friends nav-icon"></i>
        <p>Users List</p>
      </a>
    </li>              
    <li class="nav-item">
      <a href="{{ url('admin/delivery-team') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-truck nav-icon"></i>
        <p>Driver List</p>
      </a>
    </li>
  </ul>
</li>
@endif
<li class="nav-item has-treeview" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px; margin-top:3px;">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cog"></i>
    <p>
      Options
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('admin/pickup-delivery') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-truck-loading nav-icon"></i>
        <p>Pickup/Delivery</p>
      </a>
    </li>              
    <li class="nav-item">
      <a href="{{ url('admin/order-list') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-file-pdf nav-icon"></i>
        <p>PDF Generation</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item has-treeview" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px; margin-top:3px;">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-chart-bar"></i>
    <p>
      Reports
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('admin/orders-report') }}" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-file-invoice nav-icon"></i>
        <p>Orders Report</p>
      </a>
    </li>              
    <li class="nav-item">
      <a href="#" class="nav-link" style="background-color: rgba(255, 255, 255, 0.25); color: #fff; border-radius:3px;">
        <i class="fas fa-chart-line nav-icon"></i>
        <p>Sales Report</p>
      </a>
    </li>
  </ul>
</li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>