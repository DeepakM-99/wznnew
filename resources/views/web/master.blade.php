<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WZN Healthy Foods</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{url('/web/images/favicon.ico')}}" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />  
    <link rel="stylesheet" href="{{ url('/web/style.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ url('/web/responsive.css') }}?v={{ time() }}" />


    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    <!-- Owl Carousel CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  </head>

  <body>
    @yield('content')
    
    @include('web.footer')

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script>
      $(document).ready(function () {
        $("#reviews-carousel").owlCarousel({
          items: 1,
          loop: true,
          margin: 10,
          nav: false,
          dots: true,
          autoplay: true,
          autoplayTimeout: 1000,
          autoplayHoverPause: true,
        });
      });

      $(document).ready(function () {
        $("#cmd-carousel").owlCarousel({
          items: 2.2,
          loop: true,
          margin: 10,
          nav: false,
          dots: true,
          autoplay: true,
          autoplayTimeout: 1000,
          autoplayHoverPause: true,
          center: true,
        });
      });
    </script>
  </body>
</html>