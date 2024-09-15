@extends('layouts.app')
@section('style')
<!-- Add any custom styles here -->
<style>
    .meal-plan-table {
        width: 100%;
        table-layout: fixed;
    }

    .meal-plan-table th,
    .meal-plan-table td {
        text-align: center;
        vertical-align: middle;
        border: 1px solid #000;
    }

    .meal-plan-table th {
        background-color: #f8f9fa;
    }

    .meal-header {
        background-color: #FFD700; /* Yellow color */
    }

    .meal-header.green {
        background-color: #32CD32; /* Green color */
    }

    .plus-icon {
        cursor: pointer;
        font-size: 24px;
        color: #007bff;
    }

    .plus-icon:hover {
        color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
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
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Generate Plan</h3>
                    </div>
                    <br>

                    <div class="card-body" style="overflow:scroll;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2" class="meal-header" style="background-color: yellow">Week 1</th>
                                    <th colspan="2" class="meal-header" style="background-color: #09d921;">Week 2</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $daysOfWeek = [
                                1 => 'Saturday',
                                2 => 'Sunday',
                                3 => 'Monday',
                                4 => 'Tuesday',
                                5 => 'Wednesday',
                                6 => 'Thursday',
                                // Skip Friday
                            ];
                            @endphp
                            @foreach($daysOfWeek as $dayWithoutPrefix => $dayName)
                                <!-- Saturday Row -->
                                <tr class="accordion-toggle" data-day="{{ strtolower($dayName) }}">
                                    <td colspan="5" style="background-color: #F4A460; cursor: pointer;">{{$dayName}}</td>
                                </tr>
                                <!-- Meal and Snack Rows for Saturday -->
                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                    <td class="meal-header" style="background-color: yellow">MEAL 1</td>
                                    <td class="meal-header" style="background-color: yellow">SNACK 1</td>
                                    <td class="meal-header" style="background-color: #09d921;">MEAL 1</td>
                                    <td class="meal-header" style="background-color: #09d921;">SNACK 1</td>
                                </tr>
                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                    <!-- WEEK1 & WEEK2 -->
                                    @foreach([1, 2] as $week)
                                        @foreach([3 => 'MEAL', 4 => 'SNACK'] as $mealType => $type)
                                            <td>                
                                                @for ($position = 1; $position <= 4; $position++)
                                                    @php
                                                        // Meal ID should be unique for each MEAL/SNACK type and position
                                                        $mealId = $position; 
                                                        $data = isset($structuredData[$week][$dayWithoutPrefix][$mealType][2]) 
                                                                ? $structuredData[$week][$dayWithoutPrefix][$mealType][2] 
                                                                : null;                           
                                                    @endphp    
                                                    <div> 
                                                        <center>
                                                    @if(!empty($data[$position]))               
                                                    <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                          data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                          {{ $data[$position]->menu }}
                                                    </span>
                                                    @else
                                                    <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                          data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                          <!-- {{ $position }}+ -->
                                                          <img src="{{ url('assets/image/icon-plus.png') }}" alt="Green Plus Icon" style="width: 20px; height: 20px;">
                                                    
                                                    </span>
                                                    @endif
                                                    </center>
                                                    </div>
                                                @endfor                
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>


                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                    <td class="meal-header" style="background-color: yellow">MEAL 2</td>
                                    <td class="meal-header" style="background-color: yellow">SNACK 2</td>
                                    <td class="meal-header" style="background-color: #09d921;">MEAL 2</td>
                                    <td class="meal-header" style="background-color: #09d921;">SNACK 2</td>
                                </tr>
                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                <!-- WEEK1 & WEEK2 -->
                                @foreach([1, 2] as $week)
                                    @foreach([3 => 'MEAL', 4 => 'SNACK'] as $mealType => $type)
                                        <td>
                                            @for ($position = 5; $position <= 8; $position++)
                                                @php
                                                    // Meal ID should remain the same across both weeks, starting from 5 to 8
                                                    $mealId = $position; 
                                                    // Fetch data for the current week and meal ID
                                                    $data = isset($structuredData[$week][$dayWithoutPrefix][$mealType][2][$mealId]) 
                                                            ? $structuredData[$week][$dayWithoutPrefix][$mealType][2][$mealId] 
                                                            : null;
                                                @endphp    
                                                <div> 
                                                    <center>
                                                    @if(!empty($data))
                                                        <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                              data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                              {{ $data->menu }}
                                                        </span>
                                                    @else
                                                        <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                              data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                              <!-- {{ $position - 4 }}+ -->
                                                          <img src="{{ url('assets/image/icon-plus.png') }}" alt="Green Plus Icon" style="width: 20px; height: 20px;">
                                                    
                                                        </span>
                                                    @endif
                                                    </center>
                                                </div>
                                            @endfor                
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                    <td class="meal-header" style="background-color: yellow">MEAL 3</td>
                                    <td class="meal-header" style="background-color: yellow"></td>
                                    <td class="meal-header" style="background-color: #09d921;">MEAL 3</td>
                                    <td class="meal-header" style="background-color: #09d921;"></td>
                                </tr>                                
                                <tr class="accordion-content {{ strtolower($dayName) }}">
                                    <!-- WEEK1 & WEEK2 -->
                                    @foreach([1, 2] as $week)
                                        @foreach([3 => 'MEAL', 4 => 'SNACK'] as $mealType => $type)
                                        @if(($week == 1 && $type == 'SNACK') || ($week == 2 && $type == 'SNACK'))
                                                    <!-- Skip empty columns based on conditions -->
                                                    <td></td>
                                        @else
                                            <td>
                                                @for ($position = 9; $position <= 12; $position++)
                                                    @php
                                                        // Meal ID should remain the same across both weeks, starting from 9 to 12
                                                        $mealId = $position; 
                                                        // Fetch data for the current week and meal ID
                                                        $data = isset($structuredData[$week][$dayWithoutPrefix][$mealType][2][$mealId]) 
                                                                ? $structuredData[$week][$dayWithoutPrefix][$mealType][2][$mealId] 
                                                                : null;
                                                    @endphp    
                                                    <div> 
                                                        <center>
                                                        @if(!empty($data))
                                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                                  data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                                  {{ $data->menu }}
                                                            </span>
                                                        @else
                                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal"
                                                                  data-day="{{ $dayWithoutPrefix }}" data-week="{{ $week }}" data-meal_id="{{ $mealId }}" data-meal-type="{{ $mealType }}">
                                                                  <!-- {{ $position - 8 }}+ -->
                                                          <img src="{{ url('assets/image/icon-plus.png') }}" alt="Green Plus Icon" style="width: 20px; height: 20px;">
                                                    
                                                            </span>
                                                        @endif
                                                        </center>
                                                    </div>
                                                @endfor                
                                            </td>
                                        @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                                @endforeach
                                

                                <!-- Day7 -->
                                <tr class="accordion-toggle" data-day="friday">
                                    <td colspan="5" style="background-color: #F4A460; cursor: pointer;">Friday</td>
                                </tr>
                                <tr class="accordion-content friday">
                                    <td class="meal-header">OFF</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Food Menu -->
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
                <input type="text" id="menuSearch" class="form-control mb-3" placeholder="Search for meals..." />
                <div id="foodMenuContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveFoodSelection">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
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
        // When a day header is clicked
        $('.accordion-toggle').click(function() {
            // Get the day from the data attribute
            var day = $(this).data('day');
            
            // Toggle the visibility of all rows related to the clicked day
            $('.accordion-content.' + day).toggle();
        });

        // Initially hide all accordion contents
        document.querySelectorAll('.accordion-content').forEach(content => {
            content.style.display = 'none';
        });

    });

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#foodMenuModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var day = button.data('day'); 
        var week = button.data('week'); 
        var position = button.data('meal_id');

        console.log('Opening modal for day:', day, 'week:', week); 

        $.ajax({
            url: '{{ route("admin.fetch-menu") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                day: day,
                week: week
            },
            success: function(data) {
                if (data.error) {
                    $('#foodMenuContent').html('<p>' + data.error + '</p>');
                } else {
                    console.log('Received menu items:', data.menuItems); 

                    var content = '<form id="foodSelectionForm">';
                    // content += '<div class="row">'; 
                    content += '<div class="row" id="mealList">'; 

                    var half = Math.ceil(data.menuItems.length / 2);
                    var firstHalf = data.menuItems.slice(0, half);
                    var secondHalf = data.menuItems.slice(half);

                    content += '<div class="col-md-6">';
                    firstHalf.forEach(function(item) {
                        if (item.category_id === 3 || item.category_id === 4) {
                            // content += '<div>';
                            content += '<div class="meal-item" data-menu="' + item.menu.toLowerCase() + '">';
                            content += '<input type="radio" name="menu_id" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            // content += '<div>Type: ' + item.type + ' $</div>';
                            //content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>';
                        }
                    });
                    content += '</div>';

                    content += '<div class="col-md-6">';
                    secondHalf.forEach(function(item) {
                        if (item.category_id === 3 || item.category_id === 4) {
                            // content += '<div>';
                            content += '<div class="meal-item" data-menu="' + item.menu.toLowerCase() + '">';
                            content += '<input type="radio" name="menu_id" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            // content += '<div>Type: ' + item.type + ' $</div>';
                            //content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>';
                        }
                    });
                    content += '</div>';

                    content += '</div>';
                    content += '<input type="hidden" name="day" value="' + day + '">';
                    content += '<input type="hidden" name="week" value="' + week + '">';
                    content += '<input type="hidden" name="meal_id" value="2">'; 
                    content += '<input type="hidden" name="position" value="' + position + '">'; // Position now contains only the numeric part
                    content += '<input type="hidden" name="meal_type" value="' + button.data('meal-type') + '">'; 
                    content += '</form>';
                    $('#foodMenuContent').html(content);

                    $('#menuSearch').on('keyup', function() {
                        var query = $(this).val().toLowerCase();
                        
                        // Loop through each meal item
                        $('.meal-item').each(function() {
                            var menu = $(this).data('menu').toLowerCase();
                            
                            if (menu.includes(query)) {
                                $(this).show();  // Show matching item
                            } else {
                                $(this).hide();  // Hide non-matching item
                            }
                        });

                        // Hide any parent container or columns that have no visible meal items
                        $('.col-md-6').each(function() {
                            if ($(this).find('.meal-item:visible').length === 0) {
                                $(this).hide();  // Hide the entire column if no visible items
                            } else {
                                $(this).show();  // Show the column if there are visible items
                            }
                        });

                        // Remove any leftover empty lines (dividers, hr, etc.)
                        $('hr, .divider').each(function() {
                            if ($(this).prev('.meal-item:visible').length === 0 && $(this).next('.meal-item:visible').length === 0) {
                                $(this).hide();  // Hide if surrounded by hidden meal items
                            } else {
                                $(this).show();  // Show if there are visible items before or after
                            }
                        });
                    });

                    $('input[name="menu_id"]').on('change', function() {
                        $('#selectedMealId').val($(this).val());
                    });
                }
            },
            error: function(xhr) {
                console.error('Error fetching the food menu:', xhr);
                $('#foodMenuContent').html('<p>Error loading food menu.</p>');
            }
        });
    });

    $('#saveFoodSelection').on('click', function() {
        var formData = $('#foodSelectionForm').serialize();
        console.log('Form data:', formData);

        $.ajax({
            url: '{{ route("admin.saveFoodSelection") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Selection saved successfully!');
                    console.log(response);

                    // Ensure these are part of the response
                    var position = response.position;
                    var menuItem = response.menuItem;
                    var mealType = response.mealType;
                    var week = response.week;

                    var day = response.day;
                    // Select the correct span element based on position and meal type
                    var menuSpan = $('span[data-meal_id="' + position + '"][data-meal-type="' + mealType + '"][data-week="' + week + '"][data-day="' + day + '"]');
                    // Update the span's content with the selected menu item
                    menuSpan.html(menuItem.menu);

                    // Optionally, update the data-menu_id attribute with the new menu_id
                    menuSpan.attr('data-menu_id', menuItem.menu_id);

                    // Hide the modal after the update
                    $('#foodMenuModal').modal('hide');
                } else {
                    alert('Error saving selection.');
                }
            },
            error: function(xhr) {
                console.error('Error saving the selection:', xhr);
                alert('Error saving selection.');
            }
        });
    });
});


</script>
@endsection
