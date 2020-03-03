@extends('layouts.ecommerce')

@section('title')
    <title>Konfirmasi Pembayaran - Audrey Collection</title>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Konfirmasi Pembayaran</strong></div>
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
                    <h4 class="card-title" style="color:black">Konfirmasi Pembayaran</h4>
                </div>
<div class="card-body">
                    <form action="{{ route('customer.savePayment') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group">
                            <label for="" style="color:black">Invoice ID</label>
                            <input type="text" name="invoice" class="form-control" value="{{ request()->invoice }}" required>
                            <p class="text-danger">{{ $errors->first('invoice') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:black">Nama Pengirim</label>
                            <input type="text" name="nama" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('nama') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:black">Transfer Ke</label>
                            <select name="transfer_to" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="BCA - 1234567">BCA: 1234567 a.n Audrey Collection</option>
                                <option value="Mandiri - 2345678">Mandiri: 2345678 a.n Audrey Collection</option>
                                <option value="BRI - 9876543">BCA: 9876543 a.n Audrey Collection</option>
                                <option value="BNI - 6789456">BCA: 6789456 a.n Audrey Collection</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:black">Jumlah Transfer</label>
                            <input type="number" name="amount" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('amount') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:black">Tanggal Transfer</label>
                            <input type="text" name="transfer_date" id="transfer_date" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color:black">Bukti Transfer</label>
                            <input type="file" name="proof" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('proof') }}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Konfirmasi</button>
                        </div>
                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#transfer_date').datepicker({
            "todayHighlight": true,
            "setDate": new Date(),
            "autoclose": true
        })
    </script>
@endsection
