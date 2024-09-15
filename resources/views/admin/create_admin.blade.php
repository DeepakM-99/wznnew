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
            <h1>Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
              <h3 class="card-title">Admin Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Status</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $admin)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $admin->username}}</td>
                      <td>{{ $admin->email_id }}</td>
                      <td>{{ $admin->password }}</td>
                      <td>{{ $admin->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                      <td>
                          <a href="#" class="btn btn-info btn-sm edit-button"
                              data-admin_id="{{ $admin->admin_id }}"
                              data-username="{{ $admin->username }}"
                              data-email_id="{{ $admin->email_id }}"
                              data-password="{{ $admin->password }}"
                              data-is_active="{{ $admin->is_active }}">
                                <i class=""></i> Update
                            </a>
                        </td>   
                        <td>
                          @php
                            $parameter= encrypt($admin->admin_id);
                          @endphp
                          <a href="{{ url('admin/deleteadmin', $parameter) }}" class="btn btn-danger btn-sm Confirm"><i class=""></i> Delete</a>
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
              <h4 class="modal-title">Add/Update Admin</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="adminForm" action="{{ route('admin.create-admin') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="admin_id" name="admin_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Username: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="username" name="username" required>               
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
            var admin_id = $(this).data("admin_id");
            var username = $(this).data("username");
            var email_id = $(this).data("email_id");
            var password = $(this).data("password");
            var is_active = $(this).data("is_active");

            $("#admin_id").val(admin_id);
            $("#username").val(username);
            $("#email_id").val(email_id);
            $("#password").val(password);
            $("#is_active").val(is_active);

          $('#adminForm').attr('action', '{{ route("admin.updateadmin") }}');
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


