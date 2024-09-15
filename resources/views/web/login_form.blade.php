@extends('web.master')
@section('content')
@include('web.header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .login-section {
        background-color: #f8f9fa;
        padding: 5rem 0;
    }
    .login-form, .login-details {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        height: 100%;
    }
    .login-form h1, .login-details h2 {
        color: #333;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    .form-control {
        border-radius: 5px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .login-details p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    .social-footer {
        background-color: #1a1a1a;
        padding: 1.5rem 0;
    }
    .social-footer h5 {
        font-weight: 600;
    }
    .social-footer a {
        font-size: 1.5rem;
        margin-left: 1rem;
        transition: color 0.3s ease;
    }
    .social-footer a:hover {
        color: #007bff;
    }
</style>

<section class="login-section">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-5 mb-4 mb-md-0">
                <div class="login-form">
                    <h1 class="text-center text-md-start">LOGIN</h1>
                    <form method="post" action="{{ url('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email_id" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="text-center text-md-start">
                            <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="login-details d-flex flex-column justify-content-center">
                    <h2 class="text-center text-md-start">CREATE ACCOUNT</h2>
                    <p>
                        By creating an account on our website you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.
                    </p>
                    <div class="text-center text-md-start mt-auto">
                        <a href="register" class="btn btn-primary">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="social-footer text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-0">Follow Us</h5>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</section>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#007bff'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#007bff'
        });
    @endif
</script>

@endsection