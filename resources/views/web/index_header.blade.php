<style>
  /* Hide the hamburger icon when the sidebar is open */
@media (max-width: 992px) {
  .navbar-toggler.hide {
    display: none;
  }

  /* Display close button only in mobile view */
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
  /* Optional: Adjust toggler button */
  .navbar-toggler {
    position: absolute;
    right: 15px; /* Adjust position from right */
    z-index: 10000; /* Ensure it's clickable */
  }
  .ms-auto {
    margin-top: 3rem;
    margin-left: 2rem !important;
  }
}

/* Hide the close button in desktop view */
@media (min-width: 993px) {
  .navbar-collapse .close-btn {
    display: none; /* Hide in desktop view */
  }
}
</style>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid mx-lg-5">
    <a class="navbar-brand" href="{{url('/')}}">
      <img src="{{url('/web/images/wznlogo-ezgif.com-webp-to-png-converter-removebg-preview.png')}}" alt="" />
    </a>
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Close button inside the sidebar -->
      <span class="close-btn" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-label="Close">&times;</span>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
        <li class="nav-item">
          <a href="{{url('ourmenu')}}" class="text-decoration-none text-dark nav-link fw-semibold">OUR MENU</a>
        </li>
        <li class="nav-item">
          <a href="{{url('howitworks')}}" class="text-decoration-none text-dark nav-link fw-semibold">HOW IT WORKS</a>
        </li>
        <li class="nav-item">
          <a href="{{url('faq')}}" class="text-decoration-none text-dark nav-link fw-semibold">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="{{url('contactus')}}" class="text-decoration-none text-dark nav-link fw-semibold">CONTACT US</a>
        </li>
        <li class="nav-item">
          <a href="{{url('blogs')}}" class="text-decoration-none text-dark nav-link fw-semibold">BLOG</a>
        </li>
        <li class="nav-item">
          <div id="google_translate_element"></div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @php
              $data = session()->get('userData');
            @endphp
            @if($data)
              <li><a class="dropdown-item" href="#">Hello, {{$data['full_name']}}</a></li>
              <li><a class="dropdown-item" href="{{url('my-account')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> My Account</a></li>
              <li><a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a></li>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.getElementById('navbarSupportedContent');
    var toggler = document.querySelector('.navbar-toggler');

    function updateTogglerVisibility() {
      if (sidebar.classList.contains('show')) {
        toggler.classList.add('hide');
      } else {
        toggler.classList.remove('hide');
      }
    }

    // Update visibility when sidebar is toggled
    var bsCollapse = new bootstrap.Collapse(sidebar, {
      toggle: false
    });
    
    sidebar.addEventListener('shown.bs.collapse', updateTogglerVisibility);
    sidebar.addEventListener('hidden.bs.collapse', updateTogglerVisibility);
    
    // Initial check
    updateTogglerVisibility();
  });
</script>
