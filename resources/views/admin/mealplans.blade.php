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
<!--                     <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;">
                        <i class="fas fa-plus"></i> Add
                    </a>
 -->
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow:scroll;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Meal Name</th>
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
                                    <td>{{ $meal->total_amount }}</td>
                                    <td>{{ $meal->meal_calories }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm edit-button"
                                           data-meal_id="{{ $meal->meal_id }}"
                                           data-meal_name="{{ $meal->meal_name }}"
                                           data-total_amount="{{ $meal->total_amount }}"
                                           data-meal_calories="{{ $meal->meal_calories }}">Update</a>
                                        @php
                                        $parameter= encrypt($meal->meal_id);
                                        @endphp
                                        <!-- <a href="{{ url('admin/deletemealplan', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a> -->

                                        <a href="{{ url('admin/generate-plan', $parameter) }}" class="btn btn-success btn-sm Confirm"><i class="fas fa-bars"></i></a>

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
                <label>Meal Name: *</label>
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
                  <label>Total Amount: *</label>
                </div>
                <div class="col-md-9">
                  <input type="number" class="form-control" id="total_amount" name="total_amount" required>               
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                  <label>Calories: *</label>
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

        $('.edit-button').on('click', function () {
            var mealId = $(this).data('meal_id');
            var mealName = $(this).data('meal_name');
            var totalAmount = $(this).data('total_amount');
            var mealCal = $(this).data('meal_calories');

            $('#meal_id').val(mealId);
            $('#meal_name').val(mealName);
            $('#total_amount').val(totalAmount);
            $('#meal_calories').val(mealCal);

            $('#mealForm').attr('action', '{{ route("admin.updatemealplan") }}');
            $('#myModal').modal('show');
        });
    });
</script>
@endsection
