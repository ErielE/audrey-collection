@extends('layouts.ecommerce')

@section('title')
    <title>Keranjang Belanja -Audrey Collection</title>
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
          <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <div class="site-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-12">
              <div class="border p-4 rounded" role="alert">
                Returning customer? <a href="{{ route('customer.login') }}">Click here</a> to login
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Informasi Pengiriman</h2>
              @if (session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              <div class="p-3 p-lg-5 border">
                <form class="row contact_form" action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
                    @csrf
                <div class="col-md-12 form-group p_star">
                  <label for="" class="text-black">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="first" name="customer_nama" required>
                  <p class="text-danger">{{ $errors->first('customer_nama') }}</p>
                </div>
                <div class="col-md-6 form-group p_star">
                    <label for="" class="text-black">No Telp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="number" name="customer_phone" required>
                    <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                </div>
                <div class="col-md-6 form-group p_star">
                    <label for="" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                </div>
                <div class="col-md-12 form-group p_star">
                    <label for="" class="text-black">Alamat Lengkap</label>
                    <input type="text" class="form-control" id="add1" name="customer_alamat" required>
                    <p class="text-danger">{{ $errors->first('customer_alamat') }}</p>
                </div>
                <div class="col-md-12 form-group p_star">
                  <label for="" class="text-black">Provinsi<span class="text-danger">*</span></label>
                  <select class="form-control" name="provinsi_id" id="provinsi_id" required>
                      <option value="">Pilih Propinsi</option>
                        <!-- LOOPING DATA PROVINsi UNTUK DIPILIH OLEH CUSTOMER -->
                      @foreach ($provinsis as $row)
                      <option value="{{ $row->id }}">{{ $row->nama }}</option>
                      @endforeach
                  </select>
                  <p class="text-danger">{{ $errors->first('provinsi_id') }}</p>
                </div>
                <div class="col-md-12 form-group p_star">
                  <label for="" class="text-black">Kabupaten / Kota <span class="text-danger">*</span></label>
                  <select class="form-control" name="kota_id" id="kota_id" required>
                      <option value="">Pilih Kabupaten/Kota</option>
                  </select>
                  <p class="text-danger">{{ $errors->first('kota_id') }}</p>
                </div>
                <div class="col-md-12 form-group p_star">
                  <label for="c_country" class="text-black">Kecamatan <span class="text-danger">*</span></label>
                  <select class="form-control" name="kabupaten_id" id="kabupaten_id" required>
                      <option value="">Pilih Kecamatan</option>
                  </select>
                  <p class="text-danger">{{ $errors->first('kabupaten_id') }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Ringkasan Pesanan</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Produk</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        @foreach ($carts as $cart)
                        <tr>
                          <td>{{ \Str::limit($cart['produk_nama'], 10) }}<strong class="mx-2">x {{ $cart['qty'] }}</strong> </td>
                          <td>Rp {{ number_format($cart['produk_harga']) }}</td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                          <td class="text-black">Rp {{ number_format($subtotal) }}</td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Total</strong></td>
                          <td class="text-black font-weight-bold"><strong>Rp {{ number_format($subtotal) }}</strong></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <button class="main_btn">Bayar Pesanan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- </form> -->
        </div>
      </div>
    <!--================End Checkout Area =================-->
@endsection
@section('js')
    <script>
        //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
        $('#provinsi_id').on('change', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/kota
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ url('/api/kota') }}",
                type: "GET",
                data: { provinsi_id: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID kota_ID DI KOSONGKAN
                    $('#kota_id').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#kota_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#kota_id').append('<option value="'+item.id+'">'+item.nama+'</option>')
                    })
                }
            });
        })

        //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
        $('#kota_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/kabupaten') }}",
                type: "GET",
                data: { kota_id: $(this).val() },
                success: function(html){
                    $('#kabupaten_id').empty()
                    $('#kabupaten_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#kabupaten_id').append('<option value="'+item.id+'">'+item.nama+'</option>')
                    })
                }
            });
        })
    </script>
@endsection
