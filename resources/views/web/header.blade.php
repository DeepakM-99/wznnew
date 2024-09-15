<style>
  /* Hide the close button in desktop view */
@media (min-width: 993px) {
  .navbar-collapse .close-btn {
    display: none; /* Hide in desktop view */
  }
}
  /* Open navbar from the right side in mobile view */
  @media (max-width: 992px) {
    .navbar-collapse {
      position: fixed;
      top: 0;
      right: -300px; /* Increase width to match new size */
      height: 100vh;
      width: 300px; /* Adjust width as needed */
      background-color: white;
      transition: right 0.4s ease-in-out;
      z-index: 9999; /* Ensure it's on top */
    }
    .navbar-collapse.show {
      right: 0;
    }
    /* Close button style */
    .navbar-collapse .close-btn {
      display: none; /* Hide by default */
    }
    .navbar-collapse.show .close-btn {
      display: block; /* Show when sidebar is visible */
      position: absolute;
      top: 15px; /* Adjust position from top */
      right: 15px; /* Adjust position from right */
      font-size: 1.75rem; /* Adjust size as needed */
      cursor: pointer;
      color: #333; /* Adjust color if needed */
      z-index: 10000; /* Ensure it's clickable */
    }
    /* Ensure navbar covers full screen */
    body.offcanvas-open {
      overflow: hidden;
    }
    /* Hide hamburger icon when navbar is open */
    .navbar-toggler {
      display: block; /* Ensure it's displayed by default */
    }
    .navbar-collapse.show ~ .navbar-toggler {
      display: none; /* Hide when sidebar is visible */
    }
    .ms-auto {
      margin-top: 3rem;
      margin-left: 2rem !important;
    }
  }
</style>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid mx-lg-5">
    <a class="navbar-brand" href="{{url('/')}}">
      <img
        src="{{url('/web/images/wznlogo-ezgif.com-webp-to-png-converter-removebg-preview.png')}}"
        alt="Brand Logo"
        width="150"
      />
    </a>
    <!-- Navbar toggler for mobile view -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar collapse -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Close button inside the sidebar -->
      <span class="close-btn" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-label="Close">&times;</span>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
        <li class="nav-item">
          <a
            href="{{url('ourmenu')}}"
            class="text-decoration-none text-dark nav-link fw-semibold"
          >OUR MENU</a>
        </li>
        <li class="nav-item">
          <a
            href="{{url('howitworks')}}"
            class="text-decoration-none text-dark nav-link fw-semibold"
          >HOW IT WORKS</a>
        </li>
        <li class="nav-item">
          <a
            href="{{url('faq')}}"
            class="text-decoration-none text-dark nav-link fw-semibold"
          >FAQ</a>
        </li>
        <li class="nav-item">
          <a
            href="{{url('contactus')}}"
            class="text-decoration-none text-dark nav-link fw-semibold"
          >CONTACT US</a>
        </li>
        <li class="nav-item">
          <a
            href="{{url('blogs')}}"
            class="text-decoration-none text-dark nav-link fw-semibold"
          >BLOG</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="fa fa-user" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @php
              $data = session()->get('userData');
            @endphp
            @if($data)
              <li><a class="dropdown-item" href="#">Hello, {{$data['full_name']}}</a></li>
              <li><a class="dropdown-item" href="{{url('my-account')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> My Account</a></li>
              <li><a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            @else
              <li><a class="dropdown-item" href="{{url('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
              <li><a class="dropdown-item" href="{{url('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
