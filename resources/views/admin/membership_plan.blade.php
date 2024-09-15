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
            <h1>Food Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Membership Plan</li>
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
              <h3 class="card-title">Membership Plan Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Membership Plan</th>
                  <th>Price</th>
                  <th>Language</th>
                  <th>Gender</th>
                  <th>Per Day Meal Count</th>
                  <th>Snack/Breakfast Count</th>
                  <th>Per Day Calory</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $plan)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $plan->membership_plan}}</td>
                      <td>{{ $plan->price }}</td>
                      <td>{{ $plan->language_name }}</td>
                      <td>{{ $plan->gender }}</td>
                      <td>{{ $plan->per_day_meal_count }}</td>
                      <td>{{ $plan->snack_breakfast_count }}</td>
                      <td>{{ $plan->per_day_calory }}</td>
                      <td>
                          <a href="#" class="btn btn-info btn-sm edit-button"
                              data-id="{{ $plan->plan_id }}"
                              data-plan="{{ $plan->membership_plan }}"
                              data-price="{{ $plan->price }}"
                              data-language="{{ $plan->language_id }}"
                              data-gender="{{ $plan->gender }}"
                              data-per-day="{{ $plan->per_day_meal_count }}"
                              data-snack="{{ $plan->snack_breakfast_count }}"
                              data-calory="{{ $plan->per_day_calory }}">
                                <i class=""></i> Update
                            </a>
                        </td>   
                        <td>
                          @php
                            $parameter= encrypt($plan->plan_id);
                          @endphp
                          <a href="{{ url('admin/deleteplan', $parameter) }}" class="btn btn-danger btn-sm Confirm"><i class=""></i> Delete</a>
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
              <h4 class="modal-title">Add/Update Membership Plan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="planForm" action="{{ route('admin.membership-plan') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="plan_id" name="plan_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Membership Plan*</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="membership_plan" name="membership_plan" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Language*</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="language_id" name="language_id" required>
                        <option>Select Language</option>
                        @foreach ($language as $lang)
                          <option value="{{ $lang->language_id }}">{{ $lang->language_name }}</option>
                        @endforeach
                      </select>                  
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label></label>
                    </div>
                    <div class="col-md-9">
                      <input type="radio" name="plan_duration" value="weekly" checked>   
                      <label for="html">Weekly</label>                                             
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Price*</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="price" name="price" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Gender*</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="gender" name="gender" required>
                        <option>Nothing Selected</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>                  
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Per Day Count*</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="per_day_meal_count" name="per_day_meal_count" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Snack/Breakfast Count*</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="snack_breakfast_count" name="snack_breakfast_count" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Per Day Calory*</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="per_day_calory" name="per_day_calory" required>               
                    </div>
                  </div>
                <br>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="button" name="cancel" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                  
                  <br>
                </div>
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

    $(".edit-button").click(function () {
            var plan_id = $(this).data("plan_id");
            var membership_plan = $(this).data("plan");
            var plan_duration = $(this).data("plan_duration");
            var price = $(this).data("price");
            var language_id = $(this).data("language");
            var per_day_meal_count = $(this).data("per-day");
            var gender = $(this).data("gender");
            var snack_breakfast_count = $(this).data("snack");
            var per_day_calory = $(this).data("calory");

            $("#plan_id").val(plan_id);
            $("#membership_plan").val(membership_plan);
            $("#plan_duration").val(plan_duration);
            $("#price").val(price);
            $("#language_id").val(language_id);
            $("#per_day_meal_count").val(per_day_meal_count);
            $("#gender").val(gender);
            $("#snack_breakfast_count").val(snack_breakfast_count);
            $("#per_day_calory").val(per_day_calory);

          $('#planuForm').attr('action', '{{ route("admin.updateplan") }}');
          $('#myModal').modal('show');
        });

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this menu!",
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
    });
</script>
@endsection


