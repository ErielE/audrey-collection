@extends('layouts.ecommerce')

@section('title')
    <title>Pengaturan - Audrey Collection</title>
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
            <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Pengaturan</strong></div>
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
                    <h4 class="card-title" style="color: black">Informasi Pribadi</h4>
                </div>
<div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('customer.setting') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" style="color: black">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required value="{{ $customer->nama }}">
                            <p class="text-danger">{{ $errors->first('nama') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ $customer->email }}" readonly>
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="******">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            <p>Biarkan kosong jika tidak ingin mengganti password</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">No Telp</label>
                            <input type="text" name="phone_number" class="form-control" required value="{{ $customer->phone_number }}">
                            <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required value="{{ $customer->alamat }}">
                            <p class="text-danger">{{ $errors->first('alamat') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Propinsi</label>
                            <select class="form-control" name="provinsi_id" id="provinsi_id" required>
                                <option value="">Pilih Propinsi</option>
                                @foreach ($provinsis as $row)
                                <option value="{{ $row->id }}" {{ $customer->kabupaten->provinsi_id == $row->id ? 'selected':'' }}>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('provinsi_id') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Kabupaten / Kota</label>
                            <select class="form-control" name="kota_id" id="kota_id" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('kota_id') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="" style="color: black">Kecamatan</label>
                            <select class="form-control" name="kabupaten_id" id="kabupaten_id" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('kabupaten_id') }}</p>
                        </div>
                        <button class="btn btn-primary btn-sm">Simpan</button>
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
    <script>
        //JADI KETIKA HALAMAN DI-LOAD
        $(document).ready(function(){
            //MAKA KITA MEMANGGIL FUNGSI LOADkota() DAN LOADkabupaten()
            //AGAR SECARA OTOMATIS MENGISI SELECT BOX YANG TERSEDIA
            loadkota($('#provinsi_id').val(), 'bySelect').then(() => {
                loadkabupaten($('#kota_id').val(), 'bySelect');
            })
        })

        $('#provinsi_id').on('change', function() {
            loadkota($(this).val(), '');
        })

        $('#kota_id').on('change', function() {
            loadkabupaten($(this).val(), '')
        })

        function loadkota(provinsi_id, type) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('/api/kota') }}",
                    type: "GET",
                    data: { provinsi_id: provinsi_id },
                    success: function(html){
                        $('#kota_id').empty()
                        $('#kota_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                        $.each(html.data, function(key, item) {

                            // KITA TAMPUNG VALUE kota_ID SAAT INI
                            let kota_selected = {{ $customer->kabupaten->kota_id }};
                           //KEMUDIAN DICEK, JIKA kota_SELECTED SAMA DENGAN ID kota YANG DOLOOPING MAKA 'SELECTED' AKAN DIAPPEND KE TAG OPTION
                            let selected = type == 'bySelect' && kota_selected == item.id ? 'selected':'';
                            //KEMUDIAN KITA MASUKKAN VALUE SELECTED DI ATAS KE DALAM TAG OPTION
                            $('#kota_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                            resolve()
                        })
                    }
                });
            })
        }

        //CARA KERJANYA SAMA SAJA DENGAN FUNGSI DI ATAS
        function loadkabupaten(kota_id, type) {
            $.ajax({
                url: "{{ url('/api/kabupaten') }}",
                type: "GET",
                data: { kota_id: kota_id },
                success: function(html){
                    $('#kabupaten_id').empty()
                    $('#kabupaten_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        let kabupaten_selected = {{ $customer->kabupaten->id }};
                        let selected = type == 'bySelect' && kabupaten_selected == item.id ? 'selected':'';
                        $('#kabupaten_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                    })
                }
            });
        }
    </script>
@endsection
