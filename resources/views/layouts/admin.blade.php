<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="Audrey Collection">
	<meta name="author" content="Audrey Collection">
  <meta name="keyword" content="Audrey Collection">

    @yield('title')

	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/simple-line-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">


    @include('layouts.module.header')

    <div class="app-body" id="dw">
        <div class="sidebar">

            @include('layouts.module.sidebar')

            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>


        @yield('content')

    </div>

    <footer class="app-footer">
        <div>
            <a href="https://www.instagram.com/erielerlangga_/">Eriel Erlangga</a>
            <span>&copy; 2020 diRumahSaja.</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="https://www.google.com/search?safe=strict&sxsrf=ACYBGNROtNqBbY5vmLC1tEpNt38TWOGuew%3A1580499132465&ei=vIA0Xrf-G4Xdz7sP8dmy4Ao&q=doa+adalah&oq=doa+adalah&gs_l=psy-ab.3..35i39j0l2j0i7i30l7.2120.2712..3001...0.2..0.68.306.5......0....1..gws-wiz.......0i71j0i8i7i30.zg3gX1lplu8&ved=0ahUKEwi3zO6Kyq7nAhWF7nMBHfGsDKwQ4dUDCAo&uact=5">
                Doa</a>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-tooltips.min.js') }}"></script>
    @yield('js')
</body>
</html>
