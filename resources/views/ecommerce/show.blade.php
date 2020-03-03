@extends('layouts.ecommerce')

@section('title')
    <title>Jual {{ $produk->nama }}</title>
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
          <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <a href="{{ route('front.produk') }}">Produk</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $produk->nama }}</strong></div>
        </div>
      </div>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="{{ asset('storage/produks/' . $produk->gambar) }}" alt="{{ $produk->gambar }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $produk->nama }}</h3>
                        <h2>Rp {{ number_format($produk->harga) }}</h2>
						<ul class="list">
							<li>
								<a class="active" href="#">
                                    <span>Kategori</span> : {{ $produk->kategori->nama }}</a>
							</li>
						</ul>
                        <p></p>
                        <form action="{{ route('front.cart') }}" method="POST">
                            @csrf
                            <div class="product_count">
                              <label for="qty">Quantity:</label>
                              <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                              <input type="hidden" name="produk_id" value="{{ $produk->id }}" class="form-control">
                              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                              class="increase items-count" type="button">
                                <i class="lnr lnr-chevron-up"></i>
                              </button>
                              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                              class="reduced items-count" type="button">
                                <i class="lnr lnr-chevron-down"></i>
                              </button>
                            </div>
                            <div class="card_area">
                              <button class="main_btn">Add to Cart</button>
                            </div>
                          </form>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">spesifikasi</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="color: black">
					{!! $produk->deskripsi !!}
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Berat</h5>
									</td>
									<td>
                                        <h5>{{ $produk->berat }} gr</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Harga</h5>
									</td>
									<td>
										<h5>Rp {{ number_format($produk->harga) }}</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Kategori</h5>
									</td>
									<td>
										<h5>{{ $produk->kategori->nama }}</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
@endsection
