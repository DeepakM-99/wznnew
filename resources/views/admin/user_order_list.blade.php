@extends('layouts.app')
@section('style')
<!-- CSS -->
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->    
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customer Order Details</h3>
            </div>
          <br>
          <!-- <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a> -->
             
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Mobile</th>
                  <th>Order Item</th>
                  <th>Price</th>
                  <th>Order Status</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $order)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $order->first_name}} {{ $order->last_name }}</td>
                      <td>{{ $order->personal_no }}</td>
                      <td>{{ $order->meal_name }}</td>
                      <td>{{ $order->order_amount }}</td>
                      <td>
                          @switch($order->order_status)
                              @case(0)
                                  Pending
                                  @break
                              @case(1)
                                  Processing
                                  @break
                              @case(2)
                                  Approved
                                  @break
                              @case(3)
                                  Completed
                                  @break
                              @case(4)
                                  Rejected
                                  @break
                              @default
                                  Unknown Status
                          @endswitch
                      </td>
                      <td>{{ $order->created_at }}</td>
                      <td><a href="#" class="btn btn-info btn-sm edit-button" data-order_id="{{ $order->order_id }}" data-order_status="{{ $order->order_status }}">Update Status</a>
                          @php
                              $parameter= encrypt($order->order_id);
                          @endphp
                          <a href="{{ url('admin/view-order', $parameter) }}" class="btn btn-success btn-sm Confirm"><i class="fas fa-eye"></i></a>
                          <!-- <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#freezeModal">Freeze/Unfreeze</a> -->
                          <a href="#" class="btn btn-warning btn-sm freeze-button" 
                              data-toggle="modal" 
                              data-target="#freezeModal" 
                              data-order-id="{{ $order->order_id }}"
                              data-name="{{ $order->first_name }} {{ $order->last_name }}"
                              data-mobile="{{ $order->personal_no }}"
                              data-active-membership="{{ $order->meal_name }}"
                              data-end-date="{{ $order->end_date }}">
                              Freeze
                          </a>
                          
                          @if($order->is_paused == '1')
                          <a href="#" class="btn btn-danger btn-sm pause-button" data-toggle="modal" 
                              data-order_id="{{ $order->order_id }}" data-startDate="{{ $order->start_date }}" data-endDate="{{ $order->end_date }}" data-restartDate="{{ $order->restart_date }}" data-target="#pauseMembershipModal">Paused</a>
                          @else
                          <a href="#" class="btn btn-primary btn-sm pause-button" data-toggle="modal" 
                              data-order_id="{{ $order->order_id }}" data-startDate="{{ $order->start_date }}" data-endDate="{{ $order->end_date }}" data-target="#pauseMembershipModal">Pause</a>
                          @endif
                      </td>
                    </tr>  
                    @endforeach                 
              </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Order Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <form id="orderForm" action="{{ route('admin.order-status') }}" method="post">
            @csrf
            <input type="hidden" id="order_id" name="order_id">
            <div class="row">
              <div class="col-md-3">
                <label>Order Status*</label>
              </div>
              <div class="col-md-9">
                <select name="order_status" id="order_status" class="form-control" required>
                  <option value="">--Select--</option>
                  <option value="0">Pending</option>
                  <option value="1">processing</option>
                  <option value="2">Approved</option>
                  <option value="3">Completed</option>
                  <option value="4">Rejected</option>
                </select>
              </div>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="button" name="cancel" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </form>
          </div>
        </div>
      </div>            
    </div>
    
  </div>
</div>

<!-- Freeze Modal -->
<div class="modal fade" id="freezeModal" tabindex="-1" role="dialog" aria-labelledby="freezeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="freezeModalLabel">Freeze Membership</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.freeze-membership') }}" method="POST">
                @csrf
                <input type="hidden" id="order_id" name="order_id">

              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <h6 class="font-weight-bold mb-3">Customer Information</h6>
                          <p><strong>Name:</strong> <span id="freezeCustName">John Doe</span></p>
                          <p><strong>Mobile No:</strong> <span id="freezeMobileNo">+1 234 567 8900</span></p>
                          <p><strong>Active Membership:</strong> <span id="freezeActiveMembership">Weight Gain Plan</span></p>
                          <p><strong>Upcoming Membership:</strong> <span id="freezeUpcomingMembership">Weight Gain Plan</span></p>
                      </div>
                      <div class="col-md-6">
                          <h6 class="font-weight-bold mb-3">Freeze Details</h6>
                          <div class="form-group">
                              <label for="frozenDays">Frozen Days:</label>
                              <input type="text" class="form-control" id="frozenDays" name="frozen_days" readonly>
                          </div>
                          <div class="form-group">
                              <label for="freezeDates">Select Freeze Dates:</label>
                              <input type="text" class="form-control" id="freezeDates" required>
                          </div>
                          <div class="form-group">
                              <label for="updatedEndDate">Updated End Date of Running Package:</label>
                              <input type="date" class="form-control" id="updatedEndDate" name="end_date" required>
                          </div>
                          <div class="form-group">
                              <label for="upcomingStartDate">Upcoming Membership Start Date:</label>
                              <input type="date" class="form-control" id="upcomingStartDate" name="upcoming_start_date">
                              <input type="hidden" id="upcomingEndDate" name="upcoming_end_date" />

                          </div>
                      </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-12">
                          <div class="alert alert-info" role="alert">
                              <strong>Note:</strong> You cannot freeze membership from today and tomorrow. The freeze period can start from the third day onwards.
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
        </div>
    </div>
</div>

<!-- Pause Membership Modal -->
<div class="modal fade" id="pauseMembershipModal" tabindex="-1" role="dialog" aria-labelledby="pauseMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pauseMembershipModalLabel">Pause Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pause Membership Form -->
                <form action="{{ route('pause.membership') }}" id="" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="pauseStartDate">Pause Date:</label>
                        <input type="date" id="" name="pause_start_date" class="form-control"/>
                    </div>
                    <!-- <div class="form-group">
                        <label for="dateRangeCount">Date Range Count:</label>
                        <input type="hidden" name="date_count" id="dateRangeCount" value="">
                    </div> -->
                    <div class="form-group">
                        <label for="pauseStartDate">Restart Date(Optional):</label>
                        <input type="date" id="restartDate" name="pause_restart_date" class="form-control"/>
                    </div>
                    <input type="hidden" id="orderId" name="order_id">
                    <button type="submit" class="btn btn-primary">Pause Membership</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Include Date Range Picker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<!-- Include Date Range Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


@section('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        @if (session('message'))
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            body: '{{ session('message') }}'
        });
        @endif

        $('.edit-button').on('click', function () {
            var orderId = $(this).data('order_id');
            var orderStatus = $(this).data('order_status');

            $('#order_id').val(orderId);
            $('#order_status').val(orderStatus);

            $('#orderForm').attr('action', '{{ route("admin.order-status") }}');
            $('#myModal').modal('show');
        });
    });
</script>
<script>

$(document).ready(function() {
    // Initialize datepicker for freeze dates
    $('#freezeDates').datepicker({
        multidate: true,
        format: 'yyyy-mm-dd'
    }).on('changeDate', function(e) {
        // Get selected freeze dates
        var dates = $(this).datepicker('getDates');
        var frozenDays = dates.length;

        // Display the frozen day count
        $('#frozenDays').val(frozenDays + ' days');

        // Get the current end date and upcoming start date from the modal
        var currentEndDate = $('#updatedEndDate').data('current-end-date');
        var upcomingStartDate = $('#upcomingStartDate').val();
        var upcomingEndDate = $('#upcomingEndDate').val();

        // Convert dates to JavaScript Date objects
        var endDate = new Date(currentEndDate);
        var upcomingStart = new Date(upcomingStartDate);
        var upcomingEnd = new Date(upcomingEndDate);

        // Function to add days and skip Fridays
        function addDaysSkippingFridays(date, days) {
            while (days > 0) {
                // Add a day to the date
                date.setDate(date.getDate() + 1);

                // Check if the current day is Friday (5 in JavaScript's getDay())
                if (date.getDay() !== 5) {
                    // If it's not Friday, count this day as added
                    days--;
                }
            }
            return date;
        }

        // Add the frozen days to the current end date, skipping Fridays
        var newEndDate = addDaysSkippingFridays(new Date(currentEndDate), frozenDays);

        // Format the new end date (yyyy-mm-dd)
        var formattedNewEndDate = newEndDate.toISOString().split('T')[0];

        // Update the updatedEndDate field with the new calculated end date
        $('#updatedEndDate').val(formattedNewEndDate);

        // Check if the extended current end date overlaps with the upcoming start date
        if (newEndDate > upcomingStart) {
            // Calculate the number of days the upcoming start date needs to be shifted
            var shiftDays = Math.ceil((newEndDate - upcomingStart) / (1000 * 60 * 60 * 24));

            // Shift the upcoming start date by the overlap
            var newUpcomingStartDate = addDaysSkippingFridays(upcomingStart, shiftDays);

            // Format the new upcoming start date (yyyy-mm-dd)
            var formattedNewUpcomingStartDate = newUpcomingStartDate.toISOString().split('T')[0];

            // Update the upcoming start date field
            $('#upcomingStartDate').val(formattedNewUpcomingStartDate);

            // Calculate the shift in the end date (e.g., if the membership lasts 30 days)
            var membershipDuration = Math.ceil((upcomingEnd - upcomingStart) / (1000 * 60 * 60 * 24));

            // Shift the upcoming end date by the same amount
            var newUpcomingEndDate = addDaysSkippingFridays(newUpcomingStartDate, membershipDuration);

            // Format and update the upcoming end date hidden field
            var formattedNewUpcomingEndDate = newUpcomingEndDate.toISOString().split('T')[0];
            $('#upcomingEndDate').val(formattedNewUpcomingEndDate);
        }
    });

    // Populate Freeze/Unfreeze modal with user details when button is clicked
    $('.freeze-button').on('click', function() {
        var orderId = $(this).data('order-id');
        var name = $(this).data('name');
        var mobile = $(this).data('mobile');
        var activeMembership = $(this).data('active-membership');
        var endDate = $(this).data('end-date'); // Get the end date

        // Set the order_id in the hidden input field
        $('#freezeModal input[name="order_id"]').val(orderId);

        // Set the modal fields
        $('#freezeCustName').text(name);
        $('#freezeMobileNo').text(mobile);
        $('#freezeActiveMembership').text(activeMembership);

        // Set the current end date in the updatedEndDate field and store it as data
        $('#updatedEndDate').val(endDate).data('current-end-date', endDate);

        // AJAX call to fetch the upcoming membership start date
        $.ajax({
            url: '/order/next-start-date/' + orderId, // Update the URL to match your route
            type: 'GET',
            success: function(response) {
                // Check if an upcoming start date exists
                if (response.next_start_date) {
                    // Set the upcoming membership start date field
                    $('#upcomingStartDate').val(response.next_start_date);
                    $('#upcomingEndDate').val(response.next_end_date); // Hidden field
                } else {
                    $('#upcomingStartDate').val('No upcoming membership');
                }
            },
            error: function() {
                $('#upcomingStartDate').val('Error fetching data');
            }
        });
    });
});

$(document).ready(function() {
    // Function to disable Fridays in datepickers
    function disableFridays(date) {
        var day = date.getDay();
        return day === 5 ? false : true; // Disable Fridays (5 is Friday)
    }

    // Initialize date range picker for pauseStartDate
    $('#pauseStartDate').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: $('#pauseStartDate').attr('min'),
        endDate: $('#pauseStartDate').attr('max'),
        isInvalidDate: function(date) {
            return date.day() === 5; // Disable Fridays
        }
    }, function(start, end, label) {
        var daysCount = end.diff(start, 'days') + 1;
        $('#dateRangeCount').val(daysCount); // Update hidden input field value
    });

    // When the pause button is clicked
    $('.pause-button').on('click', function() {
        var orderId = $(this).data('order_id');
        var startDate = $(this).data('start_date');
        var endDate = $(this).data('end_date');
        var restartDate = $(this).data('restart_date');

        // Set the hidden order ID input field
        $('#orderId').val(orderId);
        $('#restartDate').val(restartDate);

        // Set the min and max attributes for pauseStartDate
        $('#pauseStartDate').attr('min', startDate);
        $('#pauseStartDate').attr('max', endDate);

        // Update the date range picker ranges
        $('#pauseStartDate').data('daterangepicker').setStartDate(startDate);
        $('#pauseStartDate').data('daterangepicker').setEndDate(endDate);

        // Show the modal
        $('#pauseMembershipModal').modal('show');
    });
});
</script>
@endsection

@endsection
