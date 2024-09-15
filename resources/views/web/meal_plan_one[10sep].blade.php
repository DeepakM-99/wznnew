@extends('web.master')
@section('content')
@include('web.header')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
  .btn-primary{
    padding: 7px 10px;
  }
  .btn-danger{
    padding: 10px 20px;
  }
</style>
   <section class="position-relative bg-dark text-white" style="
    background-image: url('/web/images/balance2_large.webp');
    background-size: cover;
    background-position: center;
">
  <div class="text-center py-5 bg-dark bg-opacity-50">
    <h1 class="display-4 fw-bold">MOVE TOWARDS YOUR GOAL</h1>
  </div>
</section>

<style>
  .tips-container {
    height: 120px; /* Control the height of the container */
    overflow: hidden; /* Hide the overflow for the scrolling effect */
    position: relative;
  }

  .tips-list {
    position: absolute;
    animation: scrollTips 12s linear infinite; /* Smooth scrolling */
  }

  @keyframes scrollTips {
    0% {
      top: 100%;
    }
    100% {
      top: -100%;
    }
  }

  .bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>

<div class="bg-primary text-white py-4 text-center">
  <div class="d-flex justify-content-center gap-4">
    <div class="d-flex align-items-center gap-2">
      <span class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 2rem; height: 2rem">1</span>
      <span>DETAILS</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <span class="bg-secondary text-secondary-foreground rounded-circle d-flex align-items-center justify-content-center" style="width: 2rem; height: 2rem">2</span>
      <span>MEAL PLAN</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <span class="bg-secondary text-secondary-foreground rounded-circle d-flex align-items-center justify-content-center" style="width: 2rem; height: 2rem">3</span>
      <span>CHECKOUT</span>
    </div>
  </div>
</div>

<style>
  .btn-radio {
    width: 6rem;
    height: 6rem;
    line-height: 5rem;
    border-radius: 50%;
    font-size: 1rem;
    font-weight: 700;
  }

  .btn-radio.active {
    background-color: #17ab52;
    color: white;
  }
</style>

<section class="py-50">
  <div class="container text-center">
    <form action="{{ url('mealsplan2') }}" method="POST">
      @csrf
      <input type="hidden" name="meal_id" value="{{ $meal_id }}">
      <div class="row mb-5 pb-5 justify-content-center">
        <div class="col-md-6 py-5">
          <h2 class="fw-semibold">How many days would you like meals for?</h2>
          <div class="d-flex justify-content-center gap-4 mt-4">
            <button id="6daysBtn" type="button" class="btn btn-secondary btn-radio active" onclick="toggleRadio('days', '6')">6 DAYS</button>
            <button id="24daysBtn" type="button" class="btn btn-secondary btn-radio" onclick="toggleRadio('days', '24')">24 DAYS</button>
          </div>
          <input type="hidden" id="days" name="days" value="6">
        </div>

        <h6 class="fw-bold">Do you have any allergy? <span class="fw-bold" style="color: red;">*</span></h6>
        <div class="col-md-4">
            <!-- Yes Button -->
            <button type="button" class="btn btn-primary" id="btn_yes">Yes</button>
            <!-- No Button -->
            <button type="button" class="btn btn-danger" id="btn_no">No</button>
        </div>   
        <br> <br> 
        <!-- Allergy Dropdown (Initially Hidden) -->
        <div class="row" id="allergy_dropdown_row" style="display: none;">
          <div class="col-md-4"></div>
          <div class="col-md-4">                          
              <label for="allergy_id" class="fw-bold">Select Allergy Type</label>
              <select class="form-control" id="allergy_id" name="allergy_id[]" required multiple>
                  <option value="" disabled selected>Select your allergy</option>
                  <!-- Allergy options will be populated here dynamically -->
              </select>
          </div>
        </div> 
      </div>
        <h6 class="fw-bold">Please select the Start date of the subscription plan <span class="fw-bold" style="color: red;">*</span></h6>
        <div class="row justify-content-center">
        <div class="col-md-4">
            <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Select a date (Min 2 days ahead)" required>          
          </div>   
        </div>     
    <hr>
      <button type="submit" class="btn btn-primary text-white py-2 px-4 rounded mt-4">GENERATE PLAN</button>
    </form>
  </div>
</section>

<script>
  function toggleRadio(group, value) {
    if (group === "days") {
      document.getElementById("6daysBtn").classList.remove("active");
      document.getElementById("24daysBtn").classList.remove("active");
      if (value === "6") {
        document.getElementById("6daysBtn").classList.add("active");
      } else {
        document.getElementById("24daysBtn").classList.add("active");
      }
      document.getElementById("days").value = value;
    }
  }
  $(document).ready(function() {
      // Handle Yes button click
      $('#btn_yes').on('click', function() {
          // Show the allergy dropdown if "Yes" is clicked
          $('#allergy_dropdown_row').show();
          $('#allergy_id').prop('required', true); // Make allergy type selection required
          
          // Highlight the Yes button and remove highlight from No button
          $(this).addClass('btn-success').removeClass('btn-primary');
          $('#btn_no').removeClass('btn-danger').addClass('btn-secondary');

          // AJAX call to fetch allergy data
          $.ajax({
              url: '{{ url("get-allergy-options") }}', // Replace with your server endpoint
              method: 'GET',
              success: function(response) {
                  // Assuming response is an array of allergy objects
                  $('#allergy_id').empty().append('<option value="" disabled selected>Select your allergy</option>');
                  $.each(response, function(index, allergy) {
                      $('#allergy_id').append('<option value="' + allergy.allergy_id + '">' + allergy.allergy_name + '</option>');
                  });
              },
              error: function(error) {
                  console.error('Error fetching allergy data:', error);
                  alert('Failed to load allergy options. Please try again later.');
              }
          });
      });

      // Handle No button click
      $('#btn_no').on('click', function() {
          // Hide the allergy dropdown if "No" is clicked
          $('#allergy_dropdown_row').hide();
          $('#allergy_id').prop('required', false); // Remove the required attribute
          $('#allergy_id').val(''); // Reset the dropdown value
          
          // Highlight the No button and remove highlight from Yes button
          $(this).addClass('btn-danger').removeClass('btn-secondary');
          $('#btn_yes').removeClass('btn-success').addClass('btn-primary');
      });
  });
</script>

<section class="block-ackwolegment">
  <div class="container">
    <div class="text-center acknowledgement">
      <h2>ACKNOWLEDGEMENT OF COUNTRY</h2>
      <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-12">
          <p class="acknowledge-para">We acknowledge the Traditional Custodians of the ACT, the Ngunnawal people. We acknowledge and respect their continuing culture and the contribution they make to the life of this city and this region.</p>
        </div>
      </div>
    </div>
  </div>
</section>


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

<script>
    $(document).ready(function() {
        // Calculate the date 2 days after the current date
        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 2);

        // Initialize the date picker with the minDate and beforeShowDay to disable Fridays
        $("#start_date").datepicker({
            minDate: currentDate,
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [day !== 5, ""]; // 5 corresponds to Friday
            },
            dateFormat: "yy-mm-dd"
        });
    });
</script>
@endsection
