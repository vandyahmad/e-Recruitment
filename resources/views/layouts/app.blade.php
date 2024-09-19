<!-- JUDUL -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ecoCare Group Company</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Oxygen:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Theme Style -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital@0;1&display=swap" rel="stylesheet">

</head>
<!-- NAVBAR -->

<body>

  <header role="banner">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand " href="/"><strong>ecoCare Group Company</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample05">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="/">Home</a>
            </li>
            <li class="nav-item">
              @guest
              <a class="nav-link active" href="{{ route('login') }}">Login/Register</a>
              @else
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('pelamar.detail-login-user') }}">Profile</a>
            </li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link">
              <!-- <i class="nav-icon fas fa-sign-out-alt"></i> -->
              <p>
                {{ __('Logout') }}
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            @endguest
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- END header -->

  <div class="top-shadow"></div>

  {{-- CONTENT --}}


  @yield('content')


  {{-- FOOTER --}}
  <footer id="main-footer" class="bg-dark py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-3 text-center text-md-left">
          <a>
            <img src="{{ asset('assets/images/ecocare-group-logo.png') }}" style="height:60px;">
          </a>
          <!-- <p> Lorem ipsum dolor sit amet consectetur adipisicing elit.Aperiam cumque, esse modi maxime veniam nulla delectus dolorem -->
          </p>
        </div>
        <div class="col-md-3 text-center text-md-left">
          <h5 class="text-white">Contact Info</h5>
          <div class="text-wrap text-white"><i class="ion-location text-primary  mr-3"></i>
            Grand Slipi Tower Suite F-I 37th floor Jl. S. Parman Kav. 22-24 Jakarta 11480
          </div>
          <div class="text-nowrap text-white"><i class="ion-ios-email text-primary mr-2"></i>
            hr@ecocare.id
          </div>
          <div class="text-nowrap text-white"><i class="ion-ios-telephone text-primary mr-2"></i>
            (021) 290 222 66
          </div>
        </div>

        <div class="col-md-3 text-center text-md-left">
          <h5 class="text-white">Quick Links</h5>

          <div><a class="text-white" href="/">
              <span class="fa fa-caret-right fa-fw mr-2"></span>Home</a>
          </div>
          @if(auth()->check())
          <div><a class="text-white" href="/">
              <span class="fa fa-caret-right fa-fw mr-2"></span>Register Here</a>
          </div>
          @else
          <div><a class="text-white" href="/auth/register">
              <span class="fa fa-caret-right fa-fw mr-2"></span>Register Here</a>
          </div>
          @endif
        </div>

        <div class="col-md-3 text-center text-md-left">
          <h5 class="text-white">Find Us</h5>
          <div><a class="text-white" href="https://www.instagram.com/ecocare_id/">
              <span class="fab fa-instagram fa-fw mr-3"></span>Instagram</a>
          </div>
          <!-- <div><a class="text-white" href="https://twitter.com/BonetUtama"  >
                                <span class="fa fa-twitter fa-fw mr-3"></span>Twitter</a>
                            </div>
                            <div><a class="text-white" href="https://www.google.com/search?q=PT.+Bonet+Utama&oq=PT.+Bonet+Utama&aqs=chrome..69i57j0l4j69i60j69i61l2.6722j0j7&sourceid=chrome&ie=UTF-8" >
                              <span class="fa fa-google fa-fw mr-3"></span>Google</a>
                            </div> -->
          <div><a class="text-white" href="https://ecocare.co.id/">
              <span class="fa fa-globe fa-fw mr-3"></span>Website</a>
          </div>

        </div>

        <div class="col-md-12  text-center md-left">
          <p> Copyright &copy; <script>
              document.write(new Date().getFullYear());
            </script> All rights reserved </p>
        </div>
      </div>
    </div>
    </div>
  </footer>

  <!-- END footer -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
    </svg></div>

  <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
    $('#upload_file').on('change', function() {
      // get file name
      var fileName = $(this).val();
      var fileName = fileName.replace(/^.*\\/, "");

      // replace choose file
      $(this).next('.custom-file-label').html(fileName);
    })
    $('#upload_foto').on('change', function() {
      // get image name
      var fileName = $(this).val();
      var fileName = fileName.replace(/^.*\\/, "");

      // replace choose file
      $(this).next('.custom-file-label').html(fileName);
    })

    $('.collapse').collapse('toggle')
  </script>

</body>

</html>