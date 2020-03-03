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
          <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Produk</strong></div>
        </div>
      </div>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 order-1">
            <div class="row align">
              <div class="col-md-12 mb-5">
                <div class="float-md-left"><h2 class="text-black h5">Shop All</h2></div>
                <div class="d-flex">
                  <div class="product_top_bar mr-1 ml-md-auto">
                        <div class="left_dorp">
                            <select class="sorting">
                                <option value="1">Default sorting</option>
                                <option value="2">Default sorting 01</option>
                                <option value="4">Default sorting 02</option>
                            </select>
                            <select class="show">
                                <option value="1">Show 12</option>
                                <option value="2">Show 14</option>
                                <option value="4">Show 16</option>
                            </select>
                        </div>
                        <div class="right_page ml-auto">
                            {{ $produk->links() }}
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="row ">
                @forelse ($produk as $row)
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
                <div class="col-md-12">
                    <h3 class="text-center">Tidak ada produk</h3>
                </div>
               @endforelse
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  {{ $produk->links()}}
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="col-md-3 order-2 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
              <ul class="list-unstyled mb-0">
                @foreach ($kategori as $gori)
                    <li>
                    <!-- JIKA CHILDNYA ADA, MAKA KATEGORI INI AKAN MENG-EXPAND DATA DIBAWAHNYA -->
                        <strong><a href="{{ url('/kategori/' . $gori->slug) }}">{{ $gori->nama }}</a></strong>
                        <!-- PROSES LOOPING DATA CHILD KATEGORI -->
                            @foreach ($gori->child as $child)
                                <ul class="list" style="display: block">
                                    <li>
                                         <a href="{{ url('/kategori/' . $child->slug) }}">{{ $child->nama }}</a>
                                    </li>
                                </ul>
                            @endforeach
                    </li>
                @endforeach
              </ul>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <!--================End Category Product Area =================-->
@endsection
