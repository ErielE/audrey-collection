@extends('layouts.ecommerce')

@section('title')
    <title>Login - Audrey Collection</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
    <div class="site-blocks-cover inner-page py-5" data-aos="fade">
        <div class="container">
          <div class="row">
            <div class="col-md-4 ml-auto order-md-2 align-self-start">
              <div class="site-block-cover-content">
              <h2 class="sub-title">#AmbilPilihanMu</h2>
              <h1>Arrivals Sales</h1>
              <p><a href="#" class="btn btn-black rounded-0">Belanja Sekarang</a></p>
              </div>
            </div>
            <div class="col-md-6 order-1 align-self-end">
              <img src="{{ asset('ecommerce/images/banner1.png')}}" alt="Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>

      <div class="custom-border-bottom py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
          </div>
        </div>
      </div>
	<!--================End Home Banner Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="offset-md-3 col-lg-6">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

					<div class="login_form_inner">
						<h3>Log in to enter</h3>
                        <form class="row login_form" action="{{ route('customer.post_login') }}" method="post" id="contactForm" novalidate="novalidate">
                            @csrf
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="******">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="remember">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="btn submit_btn">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
