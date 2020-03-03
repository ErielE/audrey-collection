@extends('layouts.ecommerce')

@section('title')
    <title>Keranjang Belanja - Audrey Collection</title>
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
          <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Invoice</strong></div>
        </div>
      </div>
    </div>
	<!--================End Home Banner Area =================-->

    <!--================Order Details Area =================-->
	<section class="order_details p_120">
		<div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h2 class="display-3 text-black">Terima Kasih!</h2>
                    <h3 class="title_confirmation">Pesanan Anda Telah Kami Terima.</h3>
                </div>
            </div>
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Informasi Pesanan</h4>
						<ul class="list">
							<li>
								<a href="#">
                  <span>Invoice</span> : {{ $order->invoice }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Tanggal</span> : {{ $order->created_at }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Total</span> : Rp {{ number_format($order->subtotal) }}</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Informasi Pemesan</h4>
						<ul class="list">
							<li>
								<a href="#">
                  <span>Alamat</span> : {{ $order->customer_alamat }}</a>
							</li>
							<li>
								<a href="#">
                  <span>Kota</span> : {{ $order->kabupaten->Kota->nama }}</a>
							</li>
							<li>
								<a href="#">
									<span>Country</span> : Indonesia</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
  <!--================End Order Details Area =================-->

@endsection
