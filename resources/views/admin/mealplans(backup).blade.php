@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Meal-Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Meal-Plan</li>
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
              <h3 class="card-title">Meal Plan List</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Meal Name</th>
                  <!-- <th>From Date</th>
                  <th>To Date</th> -->
                  <th>Price</th>
                  <th>Calories</th>                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $meal)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                      <td>{{ $meal->meal_name }}</td>
                      <!-- <td>{{ $meal->from_date }}</td>
                      <td>{{ $meal->to_date }}</td> -->
                      <td>{{ $meal->total_amount }}</td>
                      <td>{{ $meal->meal_calories }}</td>
                      <td>
                      <!-- <a href="#" class="btn btn-info btn-sm edit-button"
                        data-meal_id="{{ $meal->meal_id }}"
                        data-meal_name="{{ $meal->meal_name }}"
                        data-from_date="{{ $meal->from_date }}"
                        data-to_date="{{ $meal->to_date }}"
                        data-total_amount="{{ $meal->total_amount }}"
                        data-meal_calories="{{ $meal->meal_calories }}">Update</a> -->
                      <a href="#" class="btn btn-info btn-sm edit-button"
                        data-meal_id="{{ $meal->meal_id }}"
                        data-meal_name="{{ $meal->meal_name }}"
                        data-total_amount="{{ $meal->total_amount }}"
                        data-meal_calories="{{ $meal->meal_calories }}">Update</a>
                      @php
                          $parameter= encrypt($meal->meal_id);
                      @endphp
                      <a href="{{ url('admin/deletemealplan', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a>
                      <!-- Hamburger Icon with Dropdown -->
                      <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionMenuButton{{ $meal->meal_id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionMenuButton{{ $meal->meal_id }}">
                          <a href="#" class="dropdown-item edit-button"
                            data-meal_id="{{ $meal->meal_id }}"
                            data-meal_name="{{ $meal->meal_name }}"
                            data-total_amount="{{ $meal->total_amount }}"
                            data-meal_calories="{{ $meal->meal_calories }}">Update</a>
                          <a href="{{ url('admin/deletemealplan', $parameter) }}" class="dropdown-item Confirm">Delete</a>
                        </div>
                      </div>
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
              <h4 class="modal-title">Add/Update Meal-Plan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-9">
                  <form id="mealForm" action="{{ route('admin.meal-plan') }}" method="post">
                  @csrf
                  <input type="hidden" id="meal_id" name="meal_id">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Meal Name*</label>
                    </div>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="meal_name" name="meal_name" required>
                    </div>
                  </div>
                  <br>
                  <!-- <div class="row">
                      <div class="col-md-3">
                        <label>From Date*</label>
                      </div>
                      <div class="col-md-9">
                        <input type="date" class="form-control" id="from_date" name="from_date" required>               
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-3">
                        <label>To Date*</label>
                      </div>
                      <div class="col-md-9">
                        <input type="date" class="form-control" id="to_date" name="to_date" required>               
                      </div>
                  </div>
                  <br> -->
                  <div class="row">
                      <div class="col-md-3">
                        <label>Total Amount*</label>
                      </div>
                      <div class="col-md-9">
                        <input type="number" class="form-control" id="total_amount" name="total_amount" required>               
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-3">
                        <label>Calories*</label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control" id="meal_calories" name="meal_calories" required>               
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

    $('.edit-button').on('click', function() {
      var mealId = $(this).data('meal_id');
      var mealName = $(this).data('meal_name');
      // var fromDate = $(this).data('from_date');
      // var toDate = $(this).data('to_date');
      var totalAmount = $(this).data('total_amount');
      var mealCal = $(this).data('meal_calories');

      $('#meal_id').val(mealId);
      $('#meal_name').val(mealName);
      // $('#from_date').val(fromDate);
      // $('#to_date').val(toDate);
      $('#total_amount').val(totalAmount);
      $('#meal_calories').val(mealCal);

      $('#mealForm').attr('action', '{{ route("admin.updatemealplan") }}');
      $('#myModal').modal('show');
    });
  });

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this meal plan!",
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
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Calculate the date 2 days after the current date
    var currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + 2);

    // Format the date as yyyy-mm-dd
    var year = currentDate.getFullYear();
    var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
    var day = ('0' + currentDate.getDate()).slice(-2);

    var minDate = year + '-' + month + '-' + day;

    // Set the min attribute for the from_date input
    document.getElementById('from_date').setAttribute('min', minDate);
  });
  
</script>
@endsection