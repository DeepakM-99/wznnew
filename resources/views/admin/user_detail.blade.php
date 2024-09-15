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
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
              <h3 class="card-title">User Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->first_name}} {{ $user->last_name }}</td>
                      <td>{{ $user->email_id }}</td>
                      <td>{{ $user->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                      <td>
                          <a href="#" class="btn btn-info btn-sm edit-button"
                              data-user_id="{{ $user->user_id }}"
                              data-first_name="{{ $user->first_name }}"
                              data-last_name="{{ $user->last_name }}"
                              data-mobile="{{ $user->mobile }}"
                              data-email_id="{{ $user->email_id }}"
                              data-password="{{ $user->password }}"
                              data-is_active="{{ $user->is_active }}">
                                <i class=""></i> Update
                            </a>
                        </td>   
                        <td>
                          @php
                            $parameter= encrypt($user->user_id);
                          @endphp
                          <a href="{{ url('admin/deleteuser', $parameter) }}" class="btn btn-danger btn-sm Confirm"><i class=""></i> Delete</a>
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
              <h4 class="modal-title">Add/Update User</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="userForm" action="{{ route('admin.user-detail') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="user_id" name="user_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>First Name: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="first_name" name="first_name" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Last Name: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="last_name" name="last_name" required>                                                
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Mobile Number: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="mobile" name="mobile" required>                                                
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Email: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="email" class="form-control" id="email_id" name="email_id" required>                                                
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Password: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="password" name="password" required>                                                
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                        <label>Status: *</label>
                    </div>
                    <div class="col-md-9">
                        <div class="form-check">
                        <select class="form-control" id="is_active" name="is_active" required>
                            <option selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">In-active</option>
                        </select>          
                        </div>
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
            var user_id = $(this).data("user_id");
            var first_name = $(this).data("first_name");
            var last_name = $(this).data("last_name");
            var mobile = $(this).data("mobile");
            var password = $(this).data("password");
            var email_id = $(this).data("email_id");
            var is_active = $(this).data("is_active");

            $("#user_id").val(user_id);
            $("#first_name").val(first_name);
            $("#last_name").val(last_name);
            $("#mobile").val(mobile);
            $("#password").val(password);
            $("#email_id").val(email_id);
            $("#is_active").val(is_active);

          $('#userForm').attr('action', '{{ route("admin.updateuser") }}');
          $('#myModal').modal('show');
        });

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this!",
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


