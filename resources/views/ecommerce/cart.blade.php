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
          <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Keranjang</strong></div>
        </div>
      </div>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <div class="site-wrap">
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <form action="{{ route('front.update_cart') }}" class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Gambar</th>
                                        <th class="product-name">Produk</th>
                                        <th class="product-price">Harga</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carts  as $row)
                                        <tr>
                                            <td class="product-thumbnail">
                                                {{-- width="100px" height="100px" --}}
                                                <img src="{{ asset('storage/produks/' . $row['produk_gambar']) }}"alt="{{ $row['produk_nama'] }}" class="img-fluid">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $row['produk_nama'] }}</h2>
                                            </td>
                                            <td>Rp {{ number_format($row['produk_harga']) }}</td>
                                            <td>
                                                <div class="product_count">
                                                    <input type="text" name="qty[]" id="sst{{ $row['produk_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                                                    <input type="hidden" name="produk_id[]" value="{{ $row['produk_id'] }}" class="form-control">
                                                    <button onclick="var result = document.getElementById('sst{{ $row['produk_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                     class="increase items-count" type="button">
                                                        <i class="lnr lnr-chevron-up"></i>
                                                    </button>
                                                    <button onclick="var result = document.getElementById('sst{{ $row['produk_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                     class="reduced items-count" type="button">
                                                        <i class="lnr lnr-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($row['produk_harga'] * $row['qty']) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">Tidak ada belanjaan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 mb-3 mb-md-0">
                                <a href="{{ route('front.produk') }}">
                                    <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="{{ route('front.produk') }}">
                                    <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">Rp {{ number_format($subtotal) }}</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('front.checkout') }}">
                                            <button class="btn btn-primary btn-lg btn-block">Proceed To Checkout</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================end Cart Area =================-->
	<!--================Contoh Cart Area =================-->
	{{-- <section class="cart_area">
		<div class="container">
			<div class="cart_inner">

        <!-- DISABLE BAGIAN INI JIKA INGIN MELIHAT HASILNYA TERLEBIH DAHULU -->
        <!-- KARENA MODULENYA AKAN DIKERJAKAN PADA SUB BAB SELANJUTNYA -->
        <!-- HANYA SAJA DEMI KEMUDAHAN PENULISAN MAKA SAYA MASUKKAN PADA BAGIAN INI -->
                <form action="{{ route('front.update_cart') }}" method="post">
                    @csrf
        <!-- DISABLE BAGIAN INI JIKA INGIN MELIHAT HASILNYA TERLEBIH DAHULU -->

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produk</th>
								<th scope="col">Harga</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
              <!-- LOOPING DATA DARI VARIABLE CARTS -->
                            @forelse ($carts ?? '' as $row)
							<tr>
								<td>
									<div class="media">
										<div class="d-flex">
                                            <img src="{{ asset('storage/products/' . $row['product_image']) }}" width="100px" height="100px" alt="{{ $row['product_name'] }}">
										</div>
										<div class="media-body">
                                            <p>{{ $row['product_name'] }}</p>
										</div>
									</div>
								</td>
								<td>
                                    <h5>Rp {{ number_format($row['product_price']) }}</h5>
								</td>
								<td>
									<div class="product_count">
                                       <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->
                                        <input type="text" name="qty[]" id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                                        <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}" class="form-control">
                                        <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->
										<button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
										 class="increase items-count" type="button">
											<i class="lnr lnr-chevron-up"></i>
										</button>
										<button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
										 class="reduced items-count" type="button">
											<i class="lnr lnr-chevron-down"></i>
										</button>
									</div>
								</td>
								<td>
                                    <h5>Rp {{ number_format($row['product_price'] * $row['qty']) }}</h5>
								</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak ada belanjaan</td>
                            </tr>
                            @endforelse
							<tr class="bottom_button">
								<td>
									<button class="gray_btn">Update Cart</button>
								</td>
								<td></td>
								<td></td>
								<td></td>
                            </tr>
                            </form>
							<tr>
								<td>

								</td>
								<td>

								</td>
								<td>
									<h5>Subtotal</h5>
								</td>
								<td>
                                    <h5>Rp {{ number_format($subtotal) }}</h5>
								</td>
							</tr>
							{{-- <tr class="shipping_area">
								<td></td>
								<td></td>
								<td>
									<h5>Shipping</h5>
								</td>
								<td>
									<div class="shipping_box">
										<ul class="list">
											<li>
												<a href="#">Flat Rate: $5.00</a>
											</li>
											<li>
												<a href="#">Free Shipping</a>
											</li>
											<li>
												<a href="#">Flat Rate: $10.00</a>
											</li>
											<li class="active">
												<a href="#">Local Delivery: $2.00</a>
											</li>
										</ul>
										<h6>Calculate Shipping
											<i class="fa fa-caret-down" aria-hidden="true"></i>
										</h6>
										<select class="shipping_select">
											<option value="1">Bangladesh</option>
											<option value="2">India</option>
											<option value="4">Pakistan</option>
										</select>
										<select class="shipping_select">
											<option value="1">Select a State</option>
											<option value="2">Select a State</option>
											<option value="4">Select a State</option>
										</select>
										<input type="text" placeholder="Postcode/Zipcode">
										<a class="gray_btn" href="#">Update Details</a>
									</div>
								</td>
							</tr>
							<tr class="out_button_area">
								<td></td>
								<td></td>
								<td></td>
								<td>
									<div class="checkout_btn_inner">
										<a class="gray_btn" href="#">Continue Shopping</a>
										<a class="main_btn" href="#">Proceed to checkout</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section> --}}
	<!--================End contoh Cart Area =================-->
@endsection
