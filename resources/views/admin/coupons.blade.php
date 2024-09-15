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
            <h1>Coupon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupon</li>
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
              <h3 class="card-title">Coupon Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Coupon Title</th>
                  <th>Discount</th> 
                  <th>Expiry Date</th>  
                  <th>Status</th>                 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $coupon)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                      <td>{{ $coupon->coupon_title }}</td>
                      <td>{{ $coupon->discount_type }}</td>
                      <td>{{ $coupon->expiry_date }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-{{ $coupon->is_active ? 'success' : 'danger' }} toggle-status-btn" data-location-id="{{ $coupon->coupon_id }}" data-active="{{ $coupon->is_active ? 'true' : 'false' }}">
                            {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                        </button>             
                      <td>
                      <a href="#" class="btn btn-info btn-sm edit-button"
                        data-coupon_id="{{ $coupon->coupon_id }}"
                        data-coupon_title="{{ $coupon->coupon_title }}"
                        data-description="{{ $coupon->description }}"
                        data-discount_type="{{ $coupon->discount_type }}"
                        data-percent_discount="{{ $coupon->percent_discount }}"
                        data-rupee_discount="{{ $coupon->rupee_discount }}"
                        data-expiry_date="{{ $coupon->expiry_date }}">Update</a>
                      @php
                          $parameter= encrypt($coupon->coupon_id);
                      @endphp
                      <a href="{{ url('admin/deletecoupon', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a></td>
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
              <h4 class="modal-title">Add/Update Coupon</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="couponForm" action="{{ route('admin.coupon') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="coupon_id" name="coupon_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>
                        Coupon Name: *</label>
                    </div>
                    <div class="col-md-9"> 
                      <input type="text" class="form-control" id="coupon_title" name="coupon_title" required>                      
                    </div>
                  </div>  
                  <br>
                  <!-- Dropdown for Discount Type -->
                <div class="row">
                    <div class="col-md-3">
                        <label>Discount Type: *</label>
                    </div>
                    <div class="col-md-9"> 
                        <select class="form-control" id="discount_type" name="discount_type" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="percent">Percent</option>
                            <option value="rupee">Amount</option>
                        </select>
                    </div>
                </div>
                <br>

                <!-- Percent Discount Field -->
                <div class="row discount-field" id="percent_field" style="display:none;">
                    <div class="col-md-3">
                        <label>Percent Discount: *</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="percent_discount" name="percent_discount">
                    </div>
                </div>
                <br>

                <!-- Rupee Discount Field -->
                <div class="row discount-field" id="rupee_field" style="display:none;">
                    <div class="col-md-3">
                        <label>Amount Discount: *</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="rupee_discount" name="rupee_discount">
                    </div>
                </div>
                <br>

                  <div class="row">
                    <div class="col-md-3">
                      <label>
                        Expiry Date: *</label>
                    </div>
                    <div class="col-md-9"> 
                      <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>                      
                    </div>
                  </div>  
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Description: *</label>
                    </div>
                    <div class="col-md-9">
                      <textarea type="text" class="form-control" id="description" name="description" required></textarea>            
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="button" name="cancel" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
              </form> 
              </div>
            </div>           
          </div> 
          
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

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

    $('#discount_type').on('change', function() {
        var selectedValue = $(this).val();
        $('.discount-field').hide(); // Hide all discount fields
        
        if (selectedValue === 'percent') {
            $('#percent_field').show(); // Show percent discount field
        } else if (selectedValue === 'rupee') {
            $('#rupee_field').show(); // Show rupee discount field
        }
    });

    // If editing, handle pre-selected value
    // var preSelectedType = $('#discount_type').val();
    // if(preSelectedType) {
    //     $('#discount_type').trigger('change');
    // }

    $('.edit-button').on('click', function() {
      var couponUId = $(this).data('coupon_id');
      var coupon_title = $(this).data('coupon_title');
      var description = $(this).data('description');
      var discount = $(this).data('discount');
      var expiry_date = $(this).data('expiry_date');
      var discount_type = $(this).data('discount_type');
      var percent_discount = $(this).data('percent_discount');
      var rupee_discount = $(this).data('rupee_discount');

      $('#coupon_id').val(couponUId);
      $('#coupon_title').val(coupon_title);
      $('#description').val(description);
      $('#discount').val(discount);
      $('#expiry_date').val(expiry_date);
      $('#discount_type').val(discount_type).trigger('change'); // Trigger change to show correct field
      
      if (discount_type === 'percent') {
          $('#percent_discount').val(percent_discount);
      } else if (discount_type === 'rupee') {
          $('#rupee_discount').val(rupee_discount);
      }


      $('#couponForm').attr('action', '{{ route("admin.updatecoupon") }}');
      $('#myModal').modal('show');
    });
  });

document.querySelectorAll('.toggle-status-btn').forEach(button => {
  button.addEventListener('click', function() {
      let isActive = this.getAttribute('data-active') === 'true' ? false : true; // Toggle the current status
      let couponUId = this.getAttribute('data-location-id');

        fetch("{{ route('admin.coupon-status') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                coupon_id: couponUId,
                is_active: isActive
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                // Update button appearance
                button.setAttribute('data-active', isActive.toString());
                button.classList.toggle('btn-success');
                button.classList.toggle('btn-danger');
                button.textContent = isActive ? 'Active' : 'Inactive';
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this delivery location!",
            type: 'warning', // Use 'type' instead of 'icon'
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) { // Use 'result.value' instead of 'result.isConfirmed'
                console.log("Confirmed, redirecting to:", url); // Debugging log
                window.location.href = url;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Get the date input field
    var expiryDateField = document.getElementById('expiry_date');
    
    // Create a new Date object and get today's date
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var year = today.getFullYear();

    // Format date as YYYY-MM-DD
    var minDate = year + '-' + month + '-' + day;

    // Set the min attribute to today's date
    expiryDateField.setAttribute('min', minDate);
});

</script>
@endsection