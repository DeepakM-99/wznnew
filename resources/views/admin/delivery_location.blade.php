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
            <h1>Delivery Location</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Delivery Location</li>
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
              <h3 class="card-title">Delivery Location Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Location Name</th>
                  <th>Zone</th>
                  <!-- <th>Amount</th>
                  <th>Delivery Type</th> -->
                  <th>Status</th>                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $delivery)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                      <td>{{ $delivery->location_name }}</td>
                      <td>{{ $delivery->delivery_zone }}</td>
                      <!-- <td>{{ $delivery->delivery_amount }}</td>
                      <td>{{ $delivery->delivery_type }}</td> -->
                      <td>
                        <button type="button" class="btn btn-sm btn-{{ $delivery->is_active ? 'success' : 'danger' }} toggle-status-btn" data-location-id="{{ $delivery->location_id }}" data-active="{{ $delivery->is_active ? 'true' : 'false' }}">
                            {{ $delivery->is_active ? 'Active' : 'Inactive' }}
                        </button>             
                      <td>
                      <a href="#" class="btn btn-info btn-sm edit-button"
                        data-location_id="{{ $delivery->location_id }}"
                        data-location_name="{{ $delivery->location_name }}"
                        data-delivery_zone="{{ $delivery->delivery_zone }}">Update</a>
                      @php
                          $parameter= encrypt($delivery->location_id);
                      @endphp
                      <a href="{{ url('admin/deletedeliveryloc', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a></td>
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
              <h4 class="modal-title">Add/Update Delivery Location</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <form id="locationForm" action="{{ route('admin.delivery-location') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="location_id" name="location_id">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>
                        Location Name: *</label>
                    </div>
                    <div class="col-md-9"> 
                      <input type="text" class="form-control" id="location_name" name="location_name" required>                      
                    </div>
                  </div>  
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Zone: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="delivery_zone" name="delivery_zone" required>               
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

    $('.edit-button').on('click', function() {
      var locationId = $(this).data('location_id');
      var locationName = $(this).data('location_name');
      var deliveryZone = $(this).data('delivery_zone');

      $('#location_id').val(locationId);
      $('#location_name').val(locationName);
      $('#delivery_zone').val(deliveryZone);

      $('#locationForm').attr('action', '{{ route("admin.updatedeliveryloc") }}');
      $('#myModal').modal('show');
    });
  });

document.querySelectorAll('.toggle-status-btn').forEach(button => {
  button.addEventListener('click', function() {
      let isActive = this.getAttribute('data-active') === 'true' ? false : true; // Toggle the current status
      let locationId = this.getAttribute('data-location-id');

        fetch("{{ route('admin.delivery-status') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                location_id: locationId,
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
</script>
@endsection