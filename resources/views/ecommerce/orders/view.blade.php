@extends('layouts.ecommerce')

@section('title')
    <title>Order {{ $order->invoice }} - Audrey Collction</title>
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
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Pesanan  {{ $order->invoice }}</strong></div>
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
						<div class="col-md-6">
							<div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="color: black">Data Pelanggan</h4>
                </div>
				<div class="card-body">
				<table>
                        <tr>
                            <td width="30%">InvoiceID</td>
                            <td width="5%">:</td>
                            <th><a href="{{ route('customer.order_pdf', $order->invoice) }}" target="_blank"><strong>{{ $order->invoice }}</strong></a></th>
                        </tr>
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="5%">:</td>
                            <th>{{ $order->customer_nama }}</th>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td>:</td>
                            <th>{{ $order->customer_phone }}</th>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <th>{{ $order->customer_alamat }}, {{ $order->kabupaten->nama }} {{ $order->kabupaten->kota->nama }}, {{ $order->kabupaten->kota->provinsi->nama }}</th>
                        </tr>
                  </table>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="color: black">
                        Pembayaran

                        @if ($order->status == 0)
                        <a href="{{ url('member/payment?invoice=' . $order->invoice) }}" class="btn btn-primary btn-sm float-right">Konfirmasi</a>
                        @endif
                    </h4>
                </div>
								<div class="card-body">
                  @if ($order->payment)
									<table>
                      <tr>
                          <td width="30%">Nama Pengirim</td>
                          <td width="5%"></td>
                          <td>{{ $order->payment->nama }}</td>
                      </tr>
                      <tr>
                          <td>Tanggal Transfer</td>
                          <td></td>
                          <td>{{ $order->payment->transfer_date }}</td>
                      </tr>
                      <tr>
                          <td>Jumlah Transfer</td>
                          <td></td>
                          <td>Rp {{ number_format($order->payment->amount) }}</td>
                      </tr>
                      <tr>
                          <td>Tujuan Transfer</td>
                          <td></td>
                          <td>{{ $order->payment->transfer_to }}</td>
                      </tr>
                      <tr>
                          <td>Bukti Transfer</td>
                          <td></td>
                          <td>
                              <img src="{{ asset('storage/payment/' . $order->payment->proof) }}" width="50px" height="50px" alt="">
                              <a href="{{ asset('storage/payment/' . $order->payment->proof) }}" target="_blank">Lihat Detail</a>
                          </td>
                      </tr>
                  </table>
                  @else
                  <h4 class="text-center">Belum ada data pembayaran</h4>
                  @endif
								</div>
							</div>
              </div>
              <div class="col-md-12 mt-4">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title" style="color: black">Detail</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th style="color: black">Nama Produk</th>
                                          <th style="color: black">Harga</th>
                                          <th style="color: black">Quantity</th>
                                          <th style="color: black">Berat</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($order->details as $row)
                                      <tr>
                                          <td>{{ $row->produk->nama }}</td>
                                          <td>{{ number_format($row->harga) }}</td>
                                          <td>{{ $row->qty }} Item</td>
                                          <td>{{ $row->berat }} gr</td>
                                      </tr>
                                      @empty
                                      <tr></tr>
                                          <td colspan="4" class="text-center">Tidak ada data</td>
                                      </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
