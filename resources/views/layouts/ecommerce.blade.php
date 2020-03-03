<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <link rel="stylesheet" href="ecommerce/https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ asset('ecommerce/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/linericon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/nice-select/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/animate-css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/jquery-ui/jquery-ui.css') }}">

	<link rel="stylesheet" href="{{ asset('ecommerce/css/style2.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('ecommerce/css/aos.css')}}">

    <link rel="stylesheet" href="{{ asset('ecommerce/css/style.css')}}">
    <style>
        .menu-sidebar-area {
          list-style-type:none; padding-left: 0; font-size: 15pt;
        }
        .menu-sidebar-area > li {
          margin:0 0 10px 0;
          list-style-position:inside;
          border-bottom: 1px solid black;
        }
        .menu-sidebar-area > li > a {
          color: black
        }
      </style>
    @yield('css')
    @yield('css-style')

  </head>
  <body>
      		<div class="top_menu row m0">
			<div class="container-fluid">
				<div class="float-left">
					<p>Call Us: +62 96092 80804</p>
				</div>
				<div class="float-right">
					<ul class="right_side">
						@if (auth()->guard('customer')->check())
                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ route('customer.login') }}">Login</a></li>
                        @endif
						<li><a href="{{ route('customer.dashboard') }}">My Account</a></li>
						<li><a href="contact.html">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>
  <div class="site-wrap">


    <div class="site-navbar bg-white py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>
      @include('layouts.ecommerce.module.menu')
    </div>

    @yield('content')


    <footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">About Us</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">Newsletter</h6>
						<p>Stay updated with our latest trends</p>
						<div id="mc_embed_signup">
							<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="subscribe_form relative">
								<div class="input-group d-flex flex-row">
									<input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '"
									 required="" type="email">
									<button class="btn sub-btn">
										<span class="lnr lnr-arrow-right"></span>
									</button>
								</div>
								<div class="mt-10 info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-footer-widget instafeed">
						<h6 class="footer_title">Instagram Feed</h6>
						<ul class="list instafeed d-flex flex-wrap">
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-01.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-02.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-03.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-04.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-05.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-06.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-07.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/images/instagram/Image-08.jpg') }}" alt="">
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="block-5 mb-5">
                        <h3 class="footer_title">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">Miko Mall Lantai 1 Blok B 06 - 01</li>
                                <li class="phone"><a href="tel://23923929210">+62 96092 80804</a></li>
                                <li class="email">smpnpb38@gmail.com</li>
                            </ul>
                    </div>
				</div>
			</div>
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-12 footer-text text-center">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    All rights reserved | This E-commerce is made with
                    <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.instagram.com/erielerlangga_/" target="_blank">Eriel Erlangga</a>
				</p>
			</div>
		</div>
	</footer>
  </div>

    <script src="{{ asset('ecommerce/js/jj.js')}}"></script>
    <script src="{{ asset('ecommerce/js/jquery-ui.js')}}"></script>
    <script src="{{ asset('ecommerce/js/popper.min.js')}}"></script>
    <script src="{{ asset('ecommerce/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('ecommerce/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('ecommerce/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('ecommerce/js/aos.js')}}"></script>
    <script src="{{ asset('ecommerce/js/main.js')}}"></script>
	<script src="{{ asset('ecommerce/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/popper.js') }}"></script>
	<script src="{{ asset('ecommerce/js/bootstrap2.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/stellar.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/isotope-min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/flipclock/timer.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
	<script src="{{ asset('ecommerce/js/mail-script.js') }}"></script>
	<script src="{{ asset('ecommerce/js/theme.js') }}"></script>
	@yield('js')
  </body>
</html>
