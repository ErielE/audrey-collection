@extends('layouts.ecommerce')

@section('title')
    <title>Audrey Collection</title>
@endsection
@section('css-style')
<style>
    .btn:hover, .btn:active, .btn:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    color: #ffffff;
    background-color: #007bff;
    border-color: #007bff;

}
</style>
@endsection
@section('content')
    <!--================Home Banner Area =================-->
    <div class="site-blocks-cover" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
            <h2 class="sub-title">#AmbilPilahanMu</h2>
            <h1>Arrivals Sales</h1>
            <p><a href="#" class="btn btn-black rounded-0">Belanja Sekarang</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="{{ asset('ecommerce/images/banner.png')}}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================Feature Product Area =================-->
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="title-section mb-5 col-12">
                    <h2 class="text-uppercase">Produk Terbaru</h2>
                </div>
            </div>

            <div class="row" id="produk_terbaru">

                {{-- @forelse($produk as $row)

                            <div class="col-lg-4 col-md-6 item-entry mb-4">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ asset('storage/produks/' . $row->gambar) }}" alt="{{ $row->nama }}">
                                            <form action="{{ route('front.cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="qty" id="sst" maxlength="1" value="1" class="input-text qty">
                                                <input type="hidden" name="produk_id" value="{{ $row->id }}" class="form-control">
                                                    <button class="p_icon btn btn-lg btn-light">
                                                        <i class="icon-shopping-bag"></i>
                                                    </button>
                                            </form>
                                    </div>
                                    <a href="{{ url('/produk/' . $row->slug) }}">
                                        <h4>{{ $row->nama }}</h4>
                                    </a>
                                    <h5>Rp {{ number_format($row->harga) }}</h5>
                                </div>
                            </div>
                @empty
                @endforelse --}}
            </div>

        </div>
    </div>
    <!--================End Feature Product Area =================-->

    <!--================banner Area =================-->
     <div class="site-blocks-cover inner-page py-5" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
            <h2 class="sub-title">#AmbilPilihanMu</h2>
            <h1>New Hijab</h1>
            <p><a class="btn btn-black rounded-0" id="qq">Belanja Sekarang</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="{{ asset('ecommerce/images/banner1.png')}}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <!--================Banner  Area =================-->
@endsection
@section('js')
    <script src="{{ asset('js/frontend.js') }}"></script>
@endsection
