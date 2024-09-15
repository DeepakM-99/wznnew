@extends('web.master')
@section('content')
@include('web.header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <section class="block-section block-page-contact gap-down py-50">
      <div class="container">
        <header class="text-center mb-3">
          <h1><b>Contact us</b></h1>
          <div class="row justify-content-center">
            <div class="col-md-7 col-sm-9 col-12"></div>
          </div>
        </header>
        <div class="row justify-content-center">
          <div class="col-md-4 col-12">
            <div class="block-address">
              <address>
                <ul>
                  <li>
                    <strong>Address: </strong>1/12 Lyell Street, Fyshwick, ACT
                  </li>
                </ul>

                <div style="width: 100%">
                  <iframe
                    width="100%"
                    height="400"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    ><a href="https://www.gps.ie/">gps trackers</a></iframe
                  >
                </div>
              </address>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="block-form">
              <form
                method="post"
                action="{{url('contactus')}}"
                id="contact_form"
                accept-charset="UTF-8"
                class="login-form"
              >
              @csrf
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="field-input">
                      <input
                        type="text" name="first_name"
                        class="form-control mb-3"
                        id="ContactFormFirstName"
                        name="contact[FirstName]"
                        autocapitalize="words"
                        value=""
                        placeholder="First Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="field-input">
                      <input
                        type="text" name="last_name"
                        class="form-control mb-3"
                        id="ContactFormLastName"
                        name="contact[LastName]"
                        value=""
                        placeholder="Last Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="field-input">
                      <input
                        type="text" name="email_id"
                        class="form-control mb-3"
                        id="ContactFormEmail"
                        name="contact[email]"
                        autocorrect="off"
                        autocapitalize="off"
                        value=""
                        placeholder="Email Address"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="field-input">
                      <input
                        type="text" name="mobile"
                        class="form-control mb-3"
                        id="ContactFormPhone"
                        name="contact[phone-number]"
                        pattern="[0-9\-]*"
                        value=""
                        placeholder="Phone Number"
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="field-input">
                      <textarea
                        class="form-control mb-3" name="message"
                        id="ContactFormMessage"
                        name="contact[body]"
                        cols="30"
                        rows="10"
                        placeholder="Message"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="field-action text-right">
                      <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                    </div>
                  </div>
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