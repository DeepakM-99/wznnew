@extends('web.master')
@section('content')
@include('web.header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link, .nav-link.hover {background-color:#1AAB54;}
</style>
  <section>
 <div class="container my-5">
    <div class="row">
        <nav class="col-md-3 sidebar bg-light rounded p-3 mb-4" style="background-color: #e9ecef !important;">
            <h4 class="text-success mb-4">MY ACCOUNT</h4>
            <ul class="nav flex-column nav-pills" id="myTab" role="tablist">
                <li class="nav-item mb-2">
                    <a class="nav-link active d-flex align-items-center" id="dashboard-tab" data-bs-toggle="pill" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" id="orders-tab" data-bs-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="false">
                        <i class="bi bi-bag me-2"></i> Orders
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" id="membership-tab" data-bs-toggle="pill" href="#membership" role="tab" aria-controls="membership" aria-selected="false">
                        <i class="bi bi-star me-2"></i> Membership Plan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center" id="account-details-tab" data-bs-toggle="pill" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">
                        <i class="bi bi-person me-2"></i> Account Details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-danger" href="{{ url('logout') }}">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <div class="col-md-9 tab-content" id="myTabContent">
            <div class="tab-pane fade show active account-content bg-white p-4 rounded shadow-sm" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <h2 class="mb-4">Dashboard</h2>
                <p>Hello <strong>{{ $data['first_name'] }}</strong> (not {{ $data['first_name'] }}? <a href="{{url('logout')}}">Log out</a>)</p>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <a href="#" class="text-decoration-none dashboard-link" data-target="orders">
                            <div class="account-card bg-light p-3 rounded text-center">
                                <i class="bi bi-file-earmark fs-1 text-success"></i>
                                <p class="mt-2 mb-0 text-dark">Orders</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="#" class="text-decoration-none dashboard-link" data-target="membership">
                            <div class="account-card bg-light p-3 rounded text-center">
                                <i class="bi bi-star fs-1 text-success"></i>
                                <p class="mt-2 mb-0 text-dark">Membership Plan</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="#" class="text-decoration-none dashboard-link" data-target="account-details">
                            <div class="account-card bg-light p-3 rounded text-center">
                                <i class="bi bi-person fs-1 text-success"></i>
                                <p class="mt-2 mb-0 text-dark">Account details</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ url('logout') }}" class="text-decoration-none">
                            <div class="account-card bg-light p-3 rounded text-center">
                                <i class="bi bi-box-arrow-right fs-1 text-danger"></i>
                                <p class="mt-2 mb-0 text-dark">Logout</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade account-content bg-white p-4 rounded shadow-sm" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <h2 class="mb-4">Orders</h2>
                @if($orders->isEmpty())
                    <p>You have no orders yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Menu</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->meal_name }}</td>
                                        <td>
                                            @if($order->order_status == 0)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($order->order_status == 1)
                                                <span class="badge bg-primary text-dark">Processing</span>
                                            @elseif($order->order_status == 2)
                                                <span class="badge bg-primary text-dark">Approved</span>
                                            @elseif($order->order_status == 3)
                                                <span class="badge bg-success text-dark">Completed</span>
                                            @elseif($order->order_status == 4)
                                                <span class="badge bg-danger text-dark">Rejected</span>
                                            @else
                                                <span class="badge bg-warning text-dark">NA</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->order_amount }}</td>
                                        <td>
                                            @php
                                                $parameter = encrypt($order->order_id);
                                            @endphp
                                            <a href="{{ url('order-detail', $parameter) }}" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <!-- <div class="tab-pane fade account-content bg-white p-4 rounded shadow-sm" id="membership" role="tabpanel" aria-labelledby="membership-tab">
                <h2 class="mb-4">Membership Plan</h2>
                <p>Your membership plan details will be displayed here.</p>
            </div> -->
              <div class="tab-pane fade account-content" id="membership" role="tabpanel" aria-labelledby="membership-tab">
              <h2 class="mb-4">Membership Plan</h2>
                <p>Your membership plan details will be displayed here.</p>
                    <!-- Membership Plan content goes here -->
                    @if($subscriptions->isEmpty())
                        <p>You do not have any active subscriptions.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Membeship Plan</th>
                                    <th>Start Date</th>
                                    <th>Amount</th>
                                    <!-- Add more headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->meal_name }}</td>
                                        <td>{{ $subscription->start_date }}</td>
                                        <td>{{ $subscription->total_amount }}</td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <p>(To freeze & unfreeze the membership contact admin.)</p>
                </div>
            <div class="tab-pane fade account-content bg-white p-4 rounded shadow-sm" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <h2 class="mb-4">Account Details</h2>
                <p>Hello <strong>{{ $data['first_name'] }}</strong> (not {{ $data['first_name'] }} {{ $data['last_name'] }}? <a href="{{url('logout')}}">Log out</a>)</p>
                <form action="{{ url('update-account') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" value="{{ $data['first_name'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" value="{{ $data['last_name'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $data['mobile'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email_id" name="email_id" value="{{ $data['email_id'] }}">
                    </div>
                    <h5 class="mt-4">Password change</h5>
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current password (leave blank to leave unchanged)</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New password (leave blank to leave unchanged)</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirm new password</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="newPassword_confirmation">
                    </div>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

 <section class="bg-dark text-white py-4" style="background-color:black !important;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
        <h5 class="mb-0">Follow Us</h5>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dashboardLinks = document.querySelectorAll('.dashboard-link');
    dashboardLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            const tab = document.querySelector(`#${target}-tab`);
            bootstrap.Tab.getOrCreateInstance(tab).show();
        });
    });
});
</script>
  
  <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}'
        });
    @endif
</script>
@endsection