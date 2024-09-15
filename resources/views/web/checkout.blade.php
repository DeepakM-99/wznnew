@extends('web.master')
@section('content')
@include('web.header')

<style>
body {
    background-color: #f8f9fa;
}

.container {
    max-width: 1200px;
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 30px;
}

.card-header {
    background-color: #007bff;
    padding: 1rem;
}

.card-body {
    padding: 2rem;
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: inline-block;
}

.form-control {
    border-radius: 8px;
    margin-bottom: 1.5rem;
    padding: 0.75rem 1rem;
}

.row .col-md-6,
.row .col-md-4 {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

.row {
    margin-left: -0.5rem;
    margin-right: -0.5rem;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.list-group-item {
    border: none;
    padding: 0.75rem 0;
}

.sticky-checkout {
    position: sticky;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #fff;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    padding: 15px 0;
    z-index: 1000;
}

.sticky-checkout .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.tab-btn-checkout {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.tab-btn-checkout .arrow {
    margin-left: 5px;
}

.final-price-span {
    font-size: 1.1em;
}

.final-price {
    margin-left: 5px;
}

.form-group {
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.01rem;
    }

    .form-control {
        padding: 0.6rem 0.9rem;
    }

    .row .col-md-6,
    .row .col-md-4 {
        padding-left: 0;
        padding-right: 0;
        margin-bottom: 1rem;
    }

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .sticky-checkout .container {
        flex-direction: column;
        align-items: stretch;
    }

    .tab-btn-checkout, .final-price-span {
        width: 100%;
        margin-bottom: 10px;
        text-align: center;
    }
}

</style>

<div class="container py-5">
    <div class="row">
        <!-- Billing Information -->
        <div class="col-lg-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Billing Information</h4>
                </div>
                <div class="card-body">
                <form method="POST" action="{{url('order-place')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="start_date" value="{{$start_date}}">
                            <input type="hidden" name="end_date" value="{{$end_date}}">
                        <input type="hidden" name="meal_id" value="{{$meal_id}}">
                        @if(!empty($allergy_id))
                            @foreach($allergy_id as $allergy)
                                <input type="hidden" name="allergy_id[]" value="{{ $allergy }}">
                            @endforeach
                        @endif
                        <div class="form-group">
                            <label for="fullName" class="form-label">Full Name: </label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="personal_no" class="form-label">Personal No: </label>
                                <input type="tel" class="form-control" id="personal_no" name="personal_no" placeholder="Enter your number" required>
                                <input type="hidden" id="full_personal_phone" name="full_personal_phone">
                                <input type="hidden" id="personal_no_country_code" name="personal_no_country_code">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="delivery_no" class="form-label">Delivery No: </label>
                                <input type="tel" class="form-control" id="delivery_no" name="delivery_no" placeholder="Enter delivery number">
                                <input type="hidden" id="full_delivery_phone" name="full_delivery_phone">
                                <input type="hidden" id="delivery_no_country_code" name="delivery_no_country_code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="dob" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="height" class="form-label">Height (In CM): </label>
                                <input type="number" class="form-control" id="height" name="height" placeholder="Enter height">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="weight" class="form-label">Weight (In KG): </label>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="physical_activity" class="form-label">Physical activity type, frequency & duration: </label>
                            <input type="text" class="form-control" id="physical_activity" name="physical_activity" placeholder="Enter...">
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="medical_condition" class="form-label">Medical Condition: </label>
                                <input type="text" class="form-control" id="medical_condition" name="medical_condition" placeholder="Enter...">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="dietary_supplements" class="form-label">Dietary Supplements if any: </label>
                                <input type="text" class="form-control" id="dietary_supplements" name="dietary_supplements" placeholder="Enter...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="food_dislikes" class="form-label">Food Dislikes: </label>
                            <input type="text" class="form-control" id="food_dislikes" name="food_dislikes" placeholder="Enter food dislikes">
                        </div>
                        <div class="form-group">
                            <label for="delivery_id" class="form-label">Pickup/Delivery: <span class="text-danger">*</span></label>
                            <select class="form-control" id="delivery_id" name="delivery_id" required>
                                <option selected>Nothing Selected</option>
                                @foreach ($pickup_delivery as $val)
                                <option value="{{ $val->delivery_id }}">{{ $val->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="addressFields" style="display: none;">
                            <div class="form-group">
                                <label for="address" class="form-label">Address: </label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="zone_number" class="form-label">Zone Number: </label>
                                    <input type="number" class="form-control" id="zone_number" name="zone_number" placeholder="Enter zone">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="street_number" class="form-label">Street Number: </label>
                                    <input type="number" class="form-control" id="street_number" name="street_number" placeholder="Enter street">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="building_number" class="form-label">Building Number: </label>
                                    <input type="number" class="form-control" id="building_number" name="building_number" placeholder="Enter building">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="delivery_instructions" class="form-label">Delivery Instruction if any: </label>
                                    <input type="text" class="form-control" id="delivery_instructions" name="delivery_instructions" placeholder="Enter instructions">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hasCoupon" class="form-label">Do you have a coupon code?</label>
                            <select class="form-control" id="hasCoupon" name="hasCoupon">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                        <div id="couponSection" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="couponCode" class="form-label">Coupon Code: </label>
                                    <input type="text" class="form-control" id="couponCode" name="coupon_code" placeholder="Enter coupon code">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="couponAttachment" class="form-label">Attach ID Proof:</label>
                                    <input type="file" class="form-control" id="couponAttachment" name="id_proof">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                                <label class="form-check-label" for="termsCheckbox">
                                    By clicking Next, you agree to our Terms and Conditions and that you have read our Membership Rules.
                                </label>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>

        <!-- Order Summary & Payment -->
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{$meal_name}}</span>
                            <strong>QR{{$meal_price}}</strong>
                        </li>
                    </ul>
                    <h4 class="text-end">QR{{$meal_price}}</h4>
                    <input type="hidden" name="order_amount" value="{{ $meal_price }}">
                </div>
            </div>
        </div>
    </div>
</div>

<section class="sticky-checkout">
    <div class="container">
        <button type="submit" name="place_order" class="tab-btn-checkout">
            Place Order<span class="arrow is-right"></span>
        </button>
        <span class="final-price-span">Total QR<b class="final-price">{{$meal_price}}</b></span>
    </div>
</section>
</form>

<section class="bg-dark text-white py-4" style="background-color:black !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-0">Follow Us</h5>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize intlTelInput for both phone fields
    var personalInput = document.querySelector("#personal_no");
    var deliveryInput = document.querySelector("#delivery_no");

    var itiPersonal = window.intlTelInput(personalInput, {
        initialCountry: "qa",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    var itiDelivery = window.intlTelInput(deliveryInput, {
        initialCountry: "qa",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    // Form submission handler
    var form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        var fullPersonalPhone = itiPersonal.getNumber();
        var personalCountryCode = itiPersonal.getSelectedCountryData().dialCode;

        var fullDeliveryPhone = itiDelivery.getNumber();
        var deliveryCountryCode = itiDelivery.getSelectedCountryData().dialCode;

        document.querySelector('#full_personal_phone').value = fullPersonalPhone;
        document.querySelector('#personal_no_country_code').value = personalCountryCode;

        document.querySelector('#full_delivery_phone').value = fullDeliveryPhone;
        document.querySelector('#delivery_no_country_code').value = deliveryCountryCode;
    });

    // Coupon section toggle
    const hasCouponSelect = document.getElementById('hasCoupon');
    const couponSection = document.getElementById('couponSection');

    hasCouponSelect.addEventListener('change', function() {
        couponSection.style.display = this.value === 'yes' ? 'block' : 'none';
    });

    // Address fields toggle
    const deliverySelect = document.getElementById('delivery_id');
    const addressFields = document.getElementById('addressFields');

    function toggleAddressFields() {
        addressFields.style.display = deliverySelect.value === '1' ? 'block' : 'none';
    }

    deliverySelect.addEventListener('change', toggleAddressFields);
    toggleAddressFields(); // Initialize on page load
});

</script>
@endsection