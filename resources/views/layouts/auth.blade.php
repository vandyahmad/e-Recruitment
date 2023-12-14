<!-- JUDUL -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ecoCare Group</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Oxygen:400,700" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/font-awesome.min.css') }}">

  <!-- Theme Style -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<!-- NAVBAR -->

<body>



  @yield('content')


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
  <script src="{{ asset('assets/js/main.js') }}"></script>

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