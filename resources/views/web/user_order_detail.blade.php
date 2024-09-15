@extends('web.master')
@section('content')
@include('web.header')
<style>
.fw-bold {
    text-align: center;
}
</style>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<div class="container mt-5">
    <h2>User Order Details</h2>
    @if($data->isEmpty())
        <p>No order details found.</p>
    @else
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-4">
                        <h5 class="card-title">Order ID: {{ $data->first()->first()->order_id }}</h5>
                        <p class="card-text"><strong>User:</strong> {{ $data->first()->first()->first_name }} {{ $data->first()->first()->last_name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $data->first()->first()->email_id }}</p>
                        <p class="card-text"><strong>DOB:</strong> {{ $data->first()->first()->dob }}</p>
                        <p class="card-text"><strong>Meal Plan:</strong> {{ $data->first()->first()->meal_name }}</p>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-4">
                        <p class="card-text"><strong>Height:</strong> {{ $data->first()->first()->height }}</p>
                        <p class="card-text"><strong>Weight:</strong> {{ $data->first()->first()->weight }}</p>
                        <p class="card-text"><strong>Start Date:</strong> {{ $data->first()->first()->start_date }}</p>
                        <p class="card-text"><strong>Personal No.:</strong> {{ $data->first()->first()->personal_no }}</p>
                        <p class="card-text"><strong>Delivery No.:</strong> {{ $data->first()->first()->delivery_no }}</p>
                    </div>

                    <!-- Third Column -->
                    <div class="col-md-4">
                        <p class="card-text"><strong>Order Amount:</strong> {{ $data->first()->first()->order_amount }}</p>
                        <p class="card-text"><strong>Delivery Status:</strong> {{ $data->first()->first()->status }}</p>
                            <p class="card-text"><strong>Coupon Code: </strong>
                                @if($data->first()->first()->coupon_code)
                                    {{ $data->first()->first()->coupon_code }}
                                @else
                                    Not Available
                                @endif
                            </p>
                            <p class="card-text"><strong>Id Proof: </strong>
                                @if($data->first()->first()->id_proof)
                                    <a target="_blank" href="{{ $data->first()->first()->id_proof }}">
                                        <img src="{{ $data->first()->first()->id_proof }}" alt="ID Proof" width="30" height="30">
                                    </a>
                                @else
                                    Not Available
                                @endif
                            </p>
                    </div>
                </div><br>
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-4">
                        <p class="card-text"><strong>Physical Activity:</strong> {{ $data->first()->first()->physical_activity }}</p>
                        <p class="card-text"><strong>Medical Condition:</strong> {{ $data->first()->first()->medical_condition }}</p>
                        <p class="card-text"><strong>Dietary Supplements:</strong> {{ $data->first()->first()->dietary_supplements }}</p>
                        <p class="card-text"><strong>Food Dislikes:</strong> {{ $data->first()->first()->food_dislikes }}</p>
                        <p class="card-text"><strong>Delivery Instructions:</strong> 
                            {{ !empty($data->first()->first()->delivery_instructions) ? $data->first()->first()->delivery_instructions : 'NA' }}</p>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-4">
                        <p class="card-text"><strong>Address:</strong> {{ !empty($data->first()->first()->address) ? $data->first()->first()->address : 'NA' }}</p>
                        <p class="card-text"><strong>Zone No.:</strong> {{ !empty($data->first()->first()->zone_number) ? $data->first()->first()->zone_number : 'NA' }}</p>
                        <h5 class="card-title">Street No.: {{ !empty($data->first()->first()->street_number) ? $data->first()->first()->street_number : 'NA' }}</h5>
                        <p class="card-text"><strong>Building No.:</strong> {{ !empty($data->first()->first()->building_number) ? $data->first()->first()->building_number : 'NA' }}</p>
                    </div>
                </div>
                <h5 class="mt-4">Food Menu Details</h5>
                @php
                    // Mapping day numbers to day names
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


                <div class="accordion" id="dayAccordion">
                    @foreach($data as $day => $items)
                        <div class="card">
                            <div class="card-header" id="heading-{{ $day }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapse-{{ $day }}" aria-expanded="true" aria-controls="collapse-{{ $day }}">
                                        {{ $days[$day] }} <!-- Display the actual day name -->
                                    </button>
                                </h5>
                            </div>


                            <div id="collapse-{{ $day }}" class="collapse" aria-labelledby="heading-{{ $day }}">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Week 1 -->
                                        <div class="col-md-6">
                                            <h5 class="mt-3 fw-bold">Week 1</h5>


                                            <div class="row">
                                                <!-- Meal Type 3 -->
                                                <div class="col-md-6">
                                                    <h6 class="mt-3 fw-bold">Meal</h6>
                                                    <ul class="list-group mb-3">
                                                        @forelse($items->where('week', 1)->where('meal_type', 3) as $item)
                                                            <li class="list-group-item text-center">
                                                                <img src="{{ $item->media_file }}" alt="{{ $item->menu }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                                                <br>
                                                                <h6 class="mt-2">{{ $item->menu }}</h6>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">No items for Meal</li>
                                                        @endforelse
                                                    </ul>
                                                </div>


                                                <!-- Meal Type 4 -->
                                                <div class="col-md-6">
                                                    <h6 class="mt-3 fw-bold">Snack</h6>
                                                    <ul class="list-group mb-3">
                                                        @forelse($items->where('week', 1)->where('meal_type', 4) as $item)
                                                            <li class="list-group-item text-center">
                                                                <img src="{{ $item->media_file }}" alt="{{ $item->menu }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                                                <br>
                                                                <h6 class="mt-2">{{ $item->menu }}</h6>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">No items for Snack</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Week 2 -->
                                        <div class="col-md-6">
                                            <h5 class="mt-3 fw-bold">Week 2</h5>




                                            <div class="row">
                                                <!-- Meal Type 3 -->
                                                <div class="col-md-6">
                                                    <h6 class="mt-3 fw-bold">Meal</h6>
                                                    <ul class="list-group mb-3">
                                                        @forelse($items->where('week', 2)->where('meal_type', 3) as $item)
                                                            <li class="list-group-item text-center">
                                                                <img src="{{ $item->media_file }}" alt="{{ $item->menu }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                                                <br>
                                                                <h6 class="mt-2">{{ $item->menu }}</h6>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">No items for Meal</li>
                                                        @endforelse
                                                    </ul>
                                                </div>


                                                <!-- Meal Type 4 -->
                                                <div class="col-md-6">
                                                    <h6 class="mt-3 fw-bold">Snack</h6>
                                                    <ul class="list-group mb-3">
                                                        @forelse($items->where('week', 2)->where('meal_type', 4) as $item)
                                                            <li class="list-group-item text-center">
                                                                <img src="{{ $item->media_file }}" alt="{{ $item->menu }}" class="img-fluid" style="max-width: 100px; height: auto;">
                                                                <br>
                                                                <h6 class="mt-2">{{ $item->menu }}</h6>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">No items for Snack</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
