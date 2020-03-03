@extends('layouts.ecommerce')

@section('title')
    <title>Dashboard - Audrey Collection</title>
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
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Dashboard</strong></div>
          </div>
        </div>
      </div>
	<!--================End Home Banner Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					@include('layouts.ecommerce.module.sidebar')
				</div>
				<div class="col-md-9">
                    <div class="row">
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3 style="color: black">Belum Dibayar</h3>
									<hr color="black">
									<p>Rp {{ number_format($orders[0]->pending) }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3 style="color: black">Dikirim</h3>
									<hr color="black">
									<p>{{ $orders[0]->shipping }} Pesanan</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3 style="color: black">Selesai</h3>
									<hr color="black">
									<p>{{ $orders[0]->completeOrder }} Pesanan</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
