@extends('layouts.ecommerce')

@section('title')
    <title>List Pesanan - Audrey Collection</title>
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
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Pesanan</strong></div>
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
						<div class="col-md-12">
							<div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="color: black">List Pesanan</h4>
                </div>
								<div class="card-body">
									<div class="table-responsive">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                      <table class="table table-hover table-bordered">
                          <thead>
                              <tr>
                                  <th style="color: black">Invoice</th>
                                  <th style="color: black">Penerima</th>
                                  <th style="color: black">No Telp</th>
                                  <th style="color: black">Total</th>
                                  <th style="color: black">Status</th>
                                  <th style="color: black">Tanggal</th>
                                  <th style="color: black">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($orders as $row)
                              <tr>
                                  <td><strong>{{ $row->invoice }}</strong></td>
                                  <td>{{ $row->customer_nama }}</td>
                                  <td>{{ $row->customer_phone }}</td>
                                  <td>{{ number_format($row->subtotal) }}</td>
                                  <td>{!! $row->status_label !!}</td>
                                  <td>{{ $row->created_at }}</td>
                                  <td>
                                      <a href="{{ route('customer.view_order', $row->invoice) }}" class="btn btn-primary btn-sm">Detail</a>
                                  </td>
                              </tr>
                              @empty
                              <tr>
                                  <td colspan="7" class="text-center">Tidak ada pesanan</td>
                              </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
                  <div class="float-right">
                      {!! $orders->links() !!}
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
