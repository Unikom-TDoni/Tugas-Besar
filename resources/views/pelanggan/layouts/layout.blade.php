<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title_page', 'Rentall')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/pelanggan')}}/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('assets/pelanggan')}}/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{URL::asset('assets/pelanggan')}}/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{URL::asset('assets/pelanggan')}}/vendor/fontawesome/css/solid.min.css">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> --}}
    <link rel="stylesheet" href="{{URL::asset('assets/pelanggan')}}/css/main.min.css">
</head>
<body @yield('bodyattr')>
    @yield('content')
    <script src="{{URL::asset('assets/pelanggan')}}/vendor/bootstrap/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script> --}}
    <script src="{{URL::asset('assets/pelanggan')}}/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{URL::asset('assets/pelanggan')}}/vendor/swiper/swiper-bundle.min.js"></script>
    @yield('addon-js')
    <script src="{{URL::asset('assets/pelanggan')}}/js/main.js"></script>
</body>
</html>