@extends('layouts.app')

@section('style')
<!-- Add any custom CSS styles here -->
<style>
    td.bg-day-cell {
        background-color: #e0e0e0; /* You can change this to any color you like */
        font-weight: bold;
    }
    .week-header {
        font-weight: bold;
        font-size: 1.25rem; /* Adjust the font size as needed */
    }
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                        <h3 class="card-title">User Information</h3>
                    </div>
                    <div class="card-body" style="overflow: scroll;">
                        <!-- User Details -->
                        <div class="user-details mb-4">
                            <!-- <h4>User Information</h4> -->
                            <div class="row">
                                @if(!empty($data))
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $data->first()->first()->first_name }} {{ $data->first()->first()->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $data->first()->first()->email_id }}</p>
                                    <p><strong>Membership Plan:</strong> {{ $data->first()->first()->meal_name }}</p>
                                    <p><strong>Delivery Status:</strong> {{ $data->first()->first()->status }}</p>
                                    @if(!empty($data->first()->first()->is_paused == 1))
                                        <p><strong>MemberShip Status:</strong> 
                                                <span class="badge badge-danger">Paused</span>
                                        </p>
                                    @endif
                                    <!-- <p><strong>Order ID:</strong> {{ $data->first()->first()->order_id }}</p> -->
                                </div>
                                <div class="col-md-6">
                                    @if(!empty($data->first()->first()->coupon_code))
                                        <p><strong>Coupon Code:</strong> {{ $data->first()->first()->coupon_code }}</p>
                                    @else
                                        <p><strong>Coupon Code:</strong> Not Available</p>
                                    @endif

                                    @if(!empty($data->first()->first()->id_proof))
                                        <p><strong>ID Proof:</strong> 
                                            <a target="_blank" href="{{ $data->first()->first()->id_proof }}">
                                                <img src="{{ $data->first()->first()->id_proof }}" width="40" height="40" alt="ID Proof">
                                            </a>
                                        </p>
                                    @else
                                        <p><strong>ID Proof:</strong> Not Available</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <br>
                            <h5><b>Billing Information</b></h5>
                            <div class="row">                                
                                <div class="col-md-6">                                    
                                    <p><strong>Full Name : </strong> {{ !empty($data->first()->first()->full_name) ? $data->first()->first()->full_name : 'NA' }}</p>
                                    <p><strong>Personal No : </strong> 
                                        {{ !empty($data->first()->first()->personal_no_country_code) ? '+'.$data->first()->first()->personal_no_country_code : '' }} 
                                        {{ !empty($data->first()->first()->personal_no) ? $data->first()->first()->personal_no : 'NA' }}
                                    </p>

                                    <p><strong>Delivery No : </strong> 
                                        {{ !empty($data->first()->first()->delivery_no_country_code) ? '+'.$data->first()->first()->delivery_no_country_code : '' }} 
                                        {{ !empty($data->first()->first()->delivery_no) ? $data->first()->first()->delivery_no : 'NA' }}</p>
                                    <p><strong>DOB : </strong> {{ !empty($data->first()->first()->dob) ? $data->first()->first()->dob : 'NA' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Height : </strong> {{ !empty($data->first()->first()->height) ? $data->first()->first()->height : 'NA' }}</p>
                                    <p><strong>Weight : </strong> {{ !empty($data->first()->first()->weight) ? $data->first()->first()->weight : 'NA' }}</p>
                                    <p><strong>Physical activity : </strong> {{ !empty($data->first()->first()->physical_activity) ? $data->first()->first()->physical_activity : 'NA' }}</p>
                                    <p><strong>Medical Condition : </strong> {{ !empty($data->first()->first()->medical_condition) ? $data->first()->first()->medical_condition : 'NA' }}</p>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">                                    
                                    <p><strong>Dietary Supplements : </strong> {{ !empty($data->first()->first()->dietary_supplements) ? $data->first()->first()->dietary_supplements : 'NA' }}</p>
                                    <p><strong>Food Dislikes : </strong> {{ !empty($data->first()->first()->food_dislikes) ? $data->first()->first()->food_dislikes : 'NA' }}</p>
                                    <p><strong>Order Status : </strong> 
                                            @if($data->first()->first()->order_status == 1)
                                                <span class="badge badge-success">Processing</span>
                                            @elseif($data->first()->first()->order_status == 2)
                                                <span class="badge badge-danger">Approved</span>
                                            @elseif($data->first()->first()->order_status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($data->first()->first()->order_status == 3)
                                                <span class="badge badge-danger">Cpmpleted</span>
                                            @elseif($data->first()->first()->order_status == 4)
                                                <span class="badge badge-warning">Rejected</span>
                                            @else
                                                <span class="badge badge-secondary">'NA'</span>
                                            @endif</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Order Amount : </strong> {{ !empty($data->first()->first()->order_amount) ? $data->first()->first()->order_amount : 'NA' }}</p>
                                    <p><strong>Order Date : </strong> {{ !empty($data->first()->first()->created_at) ? $data->first()->first()->created_at : 'NA' }}</p>
                                </div>
                            </div>
                            @if(!empty($data->first()->first()->delivery_id === '2'))
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Address : </strong> {{ !empty($data->first()->first()->address) ? $data->first()->first()->address : 'NA' }}</p>
                                    <p><strong>Zone No. : </strong> {{ !empty($data->first()->first()->zone_number) ? $data->first()->first()->zone_number : 'NA' }}</p>
                                    <p><strong>Street No. : </strong> {{ !empty($data->first()->first()->street_number) ? $data->first()->first()->street_number : 'NA' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Building No. : </strong> {{ !empty($data->first()->first()->building_number) ? $data->first()->first()->building_number : 'NA' }}</p>
                                    <p><strong>Delivery Instructions : </strong> {{ !empty($data->first()->first()->delivery_instructions) ? $data->first()->first()->delivery_instructions : 'NA' }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($data->isEmpty())
                            <p>No order details found.</p>
                        @else
                            <div class="accordion" id="orderAccordion">

                                <!-- Accordion for Week 1 -->
                                <div class="card">
                                    <div class="card-header" id="headingWeek1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-success btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseWeek1" aria-expanded="true" aria-controls="collapseWeek1">
                                                <h5 class="week-header">Week 1</h5>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseWeek1" class="collapse show" aria-labelledby="headingWeek1">
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Meals</th>
                                                        <th>Snacks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $days = [
                                                            1 => 'Saturday',
                                                            2 => 'Sunday',
                                                            3 => 'Monday',
                                                            4 => 'Tuesday',
                                                            5 => 'Wednesday',
                                                            6 => 'Thursday',
                                                            7 => 'Friday',
                                                        ];
                                                    @endphp
                                                    @foreach($days as $dayNumber => $dayName)
                                                        <tr>
                                                            <td class="bg-day-cell"><strong>{{ $dayName }}</strong></td>
                                                            <td>
                                                                @if(isset($data[$dayNumber]))
                                                                    @foreach($data[$dayNumber]->where('week', 1)->where('meal_type', 3) as $item)
                                                                        <!-- Trigger the modal when a meal is clicked -->
                                                                        <a href="javascript:void(0);" class="meal-link" data-toggle="modal" data-target="#mealModal" data-meal-id="{{ $item->meal_id }}" data-menu-id="{{ $item->menu_id }}" data-day="{{ $dayNumber }}" data-week="1" data-meal-type="3" data-user-plan="{{$item->user_plan_id}}">
                                                                            {{ $item->menu }}
                                                                        </a><br>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(isset($data[$dayNumber]))
                                                                    @foreach($data[$dayNumber]->where('week', 1)->where('meal_type', 4) as $item)
                                                                        <a href="javascript:void(0);" class="meal-link" data-toggle="modal" data-target="#mealModal" data-meal-id="{{ $item->meal_id }}" data-menu-id="{{ $item->menu_id }}"  data-day="{{ $dayNumber }}" data-week="1" data-meal-type="4" data-user-plan="{{$item->user_plan_id}}">
                                                                            {{ $item->menu }}
                                                                        </a><br>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion for Week 2 -->
                                <div class="card">
                                    <div class="card-header" id="headingWeek2">
                                        <h2 class="mb-0">
                                            <button class="btn btn-success btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseWeek2" aria-expanded="false" aria-controls="collapseWeek2">
                                                <h5 class="week-header">Week 2</h5>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseWeek2" class="collapse" aria-labelledby="headingWeek2" data-parent="#orderAccordion">
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Meals</th>
                                                        <th>Snacks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($days as $dayNumber => $dayName)
                                                        <tr>
                                                            <td class="bg-day-cell"><strong>{{ $dayName }}</strong></td>
                                                            <td>
                                                                @if(isset($data[$dayNumber]))
                                                                    @foreach($data[$dayNumber]->where('week', 2)->where('meal_type', 3) as $item)
                                                                        <a href="javascript:void(0);" class="meal-link" data-toggle="modal" data-target="#mealModal" data-meal-id="{{ $item->meal_id }}" data-menu-id="{{ $item->menu_id }}"  data-day="{{ $dayNumber }}" data-week="2" data-meal-type="3" data-user-plan="{{$item->user_plan_id}}">
                                                                            {{ $item->menu }}
                                                                        </a><br>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(isset($data[$dayNumber]))
                                                                    @foreach($data[$dayNumber]->where('week', 2)->where('meal_type', 4) as $item)
                                                                        <a href="javascript:void(0);" class="meal-link" data-toggle="modal" data-target="#mealModal" data-meal-id="{{ $item->meal_id }}" data-menu-id="{{ $item->menu_id }}"  data-day="{{ $dayNumber }}" data-week="2" data-meal-type="4" data-user-plan="{{$item->user_plan_id}}">
                                                                            {{ $item->menu }}
                                                                        </a><br>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Replacing Meal -->
<div class="modal fade" id="mealModal" tabindex="-1" role="dialog" aria-labelledby="mealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mealModalLabel">Replace Meal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.updateMeal') }}" method="POST">
                    @csrf
                    <input type="hidden" name="meal_id" id="meal_id">
                    <!-- Hidden input field for user_plan_id -->
                    <input type="hidden" name="user_plan_id" id="user_plan_id">
                    <div class="form-group">
                        <label for="new_meal">Select New Meal:</label>
                        <select class="form-control" id="new_meal" name="menu_id">
                            <!-- Options will be populated dynamically -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Meal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    @if (session('message'))
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        body: '{{ session('message') }}'
      });
    @endif
    $(document).ready(function() {
        $('#mealModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var menuId = button.data('menu-id'); // Extract info from data-* attributes 
            var mealId = button.data('meal-id');
            var day = button.data('day');
            var week = button.data('week');
            var mealType = button.data('meal-type');
            var userPlanId = button.data('user-plan');
            
            var modal = $(this);
            modal.find('#menu_id').val(menuId);
            modal.find('#meal_id').val(mealId); // Add this line to set meal_id
            modal.find('#user_plan_id').val(userPlanId);
            
            console.log('Menu ID:', menuId); // Log menuId to ensure it's being passed correctly
            console.log('Day:', day); // Log day
            console.log('Week:', week); // Log week
            console.log('Meal Type:', mealType); // Log mealType

            // Fetch meal options and populate the dropdown
            $.ajax({
                url: '{{ route('admin.getMeals') }}',  // Ensure this is the correct route
                type: 'POST',  // Change to POST to match your method
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for POST request
                    menu_id: menuId,
                    meal_id: mealId,
                    day: day,
                    week: week,
                    meal_type: mealType,
                    user_plan_id: userPlanId

                },
                success: function(data) {
                    console.log('Meal Options:', data); // Log data to check response
                    var select = modal.find('#new_meal');
                    select.empty(); // Clear existing options
                    $.each(data, function(index, meal) {
                        select.append('<option value="' + meal.menu_id + '">' + meal.menu + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching meal options:', error);
                }
            });
        });
    });
</script>


@endsection
