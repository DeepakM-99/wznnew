@extends('web.master')
@section('content')
@include('web.header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="bg-light py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-form bg-white p-4 shadow-sm rounded">
          <h2 class="text-center mb-4">Create Account</h2>
          <form method="post" action="{{url('register')}}" id="registerForm">
            @csrf
            <div class="mb-3">
              <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
              <input type="email" name="email_id" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="mb-3">
              <input type="tel" id="phone" name="mobile" class="form-control" required>
            </div>

            <!-- Hidden fields for storing full phone number and country code -->
            <input type="hidden" name="full_phone" id="full_phone">
            <input type="hidden" name="country_code" id="country_code">

            <div class="mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-grid">
              <!-- Rename submit button to avoid conflict -->
              <button type="submit" id="submitBtn" class="btn btn-primary btn-lg">Sign Up</button>
            </div>
          </form>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<style>
  .iti {
    width: 100%;
  }
  .iti__flag {
    background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags.png");
  }
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .iti__flag {
      background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags@2x.png");
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
      initialCountry: "qa", // Set the default country
      separateDialCode: true, // Display dial code separately
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    // Form submission handler
    var form = document.querySelector('#registerForm');
    form.addEventListener('submit', function(event) {
      // Prevent the default form submission behavior
      event.preventDefault();

      // Get the full phone number and country code from intlTelInput
      var fullPhoneNumber = iti.getNumber();
      var countryCode = iti.getSelectedCountryData().dialCode;

      // Assign these values to the hidden input fields
      document.querySelector('#full_phone').value = fullPhoneNumber;
      document.querySelector('#country_code').value = countryCode;

      // Now, submit the form after setting the values
      form.submit(); // Properly refer to the form submission method
    });
  });
</script>

<script>
  @if(session('success'))
      Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '{{ session('success') }}'
      });
  @endif

  @if(session('error'))
      Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '{{ session('error') }}'
      });
  @endif
</script>
@endsection
