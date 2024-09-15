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
            <h1>Allergy/Dislikes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Allergy/Dislikes</li>
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
              <h3 class="card-title">Allergy/Dislikes</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Allergy</th>
                  <th>Update</th>                  
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $allergy)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                      <td>{{ $allergy->allergy_name }}</td>
                      <td><a href="#" class="btn btn-info btn-sm edit-button" data-id="{{ $allergy->allergy_id }}" data-name="{{ $allergy->allergy_name }}">Update</a></td>
                      @php
                          $parameter= encrypt($allergy->allergy_id);
                      @endphp
                      <td> <a href="{{ url('admin/deleteallergy', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a></td>
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
              <h4 class="modal-title">Add/Update Allergy/Dislikes</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <label>Allergy: *</label>
                </div>
                <div class="col-md-9">
                  <form id="allergyForm" action="{{ route('admin.allergy') }}" method="post">
                  @csrf
                  <input type="hidden" id="allergy_id" name="allergy_id">
                  <input type="text" class="form-control" id="allergy_name" name="allergy_name" required>
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
      var allergyId = $(this).data('id');
      var allergyName = $(this).data('name');

      $('#allergy_id').val(allergyId);
      $('#allergy_name').val(allergyName);

      $('#allergyForm').attr('action', '{{ route("admin.updateallergy") }}');
      $('#myModal').modal('show');
    });
  });

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this category!",
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
@endsection