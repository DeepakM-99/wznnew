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
                    <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;">
                        <i class="fas fa-plus"></i> Add
                    </a>

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
                                        <a href="{{ url('admin/deletemealplan', $parameter) }}" class="btn btn-danger btn-sm Confirm">Delete</a>

                                        <!-- Hamburger Icon with Dropdown -->
                                        <div class="d-inline-block">
                                            <button class="btn btn-secondary btn-sm" type="button" id="actionMenuButton{{ $meal->meal_id }}" data-toggle="modal" data-target="#foodMenuModal"
                                                data-meal_id="{{ $meal->meal_id }}"
                                                data-meal_name="{{ $meal->meal_name }}">
                                                <i class="fas fa-bars"></i>
                                            </button>
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

     <!-- New Modal for Food Menu -->
     <div class="modal fade" id="foodMenuModal" tabindex="-1" role="dialog" aria-labelledby="foodMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="foodMenuModalLabel">Food Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded here dynamically -->
                    <div id="foodMenuContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveFoodSelection">Save</button>
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

    $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url);

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this meal plan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log("Confirmed, redirecting to:", url);
                window.location.href = url;
            }
        });
    });

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

    $(document).ready(function() {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
    $('#foodMenuModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var mealId = button.data('meal_id'); // Extract meal ID from data-* attributes

        // Use AJAX to fetch the food menu for the selected meal
        $.ajax({
            url: '{{ url("/admin/fetch-menu") }}', // Using the named route
            method: 'POST',
            data: { 
                _token: '{{ csrf_token() }}' // CSRF token for security
            },
            success: function(data) {
                if (data.error) {
                    $('#foodMenuContent').html('<p>' + data.error + '</p>');
                } else {
                    var content = '<form id="foodSelectionForm">';
                    content += '<div class="row">'; // Start a new row

                    // Week 1 for Type 1
                    content += '<div class="col-md-6">';
                    content += '<h4>Week 1</h4>';
                    data.forEach(function(item) {
                        if ((item.category_id === 3 || item.category_id === 4) && item.type === 1) {
                            content += '<div>';
                            content += '<input type="checkbox" name="menu_id[]" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            content += '<div>Type: ' + item.type + ' $</div>';
                            content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>'; // Separator for each item
                        }
                    });
                    content += '</div>'; // Close left column

                    // Week 2 for Type 2
                    content += '<div class="col-md-6">';
                    content += '<h4>Week 2</h4>';
                    data.forEach(function(item) {
                        if ((item.category_id === 3 || item.category_id === 4) && item.type === 2) {
                            content += '<div>';
                            content += '<input type="checkbox" name="menu_id[]" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            content += '<div>Type: ' + item.type + ' $</div>';
                            content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>'; // Separator for each item
                        }
                    });
                    content += '</div>'; // Close right column

                    content += '</div>'; // Close row
                    content += '<input type="hidden" name="meal_id" value="' + mealId + '">';
                    content += '</form>';
                    $('#foodMenuContent').html(content);
                }
            },
            error: function(xhr) {
                console.error('Error fetching the food menu:', xhr);
                $('#foodMenuContent').html('<p>Error loading food menu.</p>');
            }
        });
    });

    // Save the selected food items when the Save button is clicked
    $('#saveFoodSelection').on('click', function() {
        var formData = $('#foodSelectionForm').serialize();

        $.ajax({
            url: '{{ url("/admin/save-food-selection") }}', // Route for saving selection
            method: 'POST',
            data: formData + '&_token={{ csrf_token() }}', // Append CSRF token
            success: function(response) {
                alert('Selection saved successfully!');
                $('#foodMenuModal').modal('hide'); // Close the modal
            },
            error: function(xhr) {
                console.error('Error saving the selection:', xhr);
                alert('Error saving selection.');
            }
        });
    });
});





    });

</script>
@endsection
