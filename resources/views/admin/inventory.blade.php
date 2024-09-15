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
            <h1>Inventory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inventory</li>
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
              <h3 class="card-title">Inventory Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Item</th>
                  <th>Code</th>
                  <th>Unit</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $inv)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $inv->item_name}}</td>
                      <td>{{ $inv->item_code }}</td>
                      <td>{{ $inv->unit_name }}</td>
                      <td>{{ $inv->price }}</td>
                      <td>{{ $inv->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                      <td>
                          <a href="#" class="btn btn-info btn-sm edit-button"
                              data-item_id="{{ $inv->item_id }}"
                              data-item_name="{{ $inv->item_name }}"
                              data-item_code="{{ $inv->item_code }}"
                              data-unit_id="{{ $inv->unit_id }}"
                              data-price="{{ $inv->price }}"
                              data-is_active="{{ $inv->is_active }}">
                                <i class=""></i> Update
                            </a>
                        </td>   
                        <td>
                          @php
                            $parameter= encrypt($inv->item_id);
                          @endphp
                          <a href="{{ url('admin/deleteinventory', $parameter) }}" class="btn btn-danger btn-sm Confirm"><i class=""></i> Delete</a>
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
              <h4 class="modal-title">Add/Update Inventory</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="itemForm" action="{{ route('admin.inventory') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="item_id" name="item_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Item Name: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="item_name" name="item_name" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Item Code: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="number" class="form-control" id="item_code" name="item_code" value="item_code" required>                                                
                    </div>
                  </div> 
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Unit: *</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="unit_id" name="unit_id" required>
                        <option selected>Nothing Selected</option>
                          @foreach ($unit as $res)
                            <option value="{{ $res->unit_id }}">{{ $res->unit_name }}</option>
                          @endforeach
                      </select>                  
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
                  <div class="row">
                    <div class="col-md-3">
                      <label>Item Price: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="number" class="form-control" id="price" name="price" required>               
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
            var item_id = $(this).data("item_id");
            var item_name = $(this).data("item_name");
            var item_code = $(this).data("item_code");
            var unit_id = $(this).data("unit_id");
            var price = $(this).data("price");
            var is_active = $(this).data("is_active");

            $("#item_id").val(item_id);
            $("#item_name").val(item_name);
            $("#item_code").val(item_code);
            $("#unit_id").val(unit_id);
            $("#price").val(price);
            $("#is_active").val(is_active);

          $('#itemForm').attr('action', '{{ route("admin.updateinventory") }}');
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


