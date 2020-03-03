@extends('layouts.admin')

@section('title')
    <title>Edit Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

          	<!-- PASTIKAN MENGIRIMKAN ID PADA ROUTE YANG DIGUNAKAN -->
            <form action="{{ route('produk.update', $produk->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
              	<!-- KARENA UPDATE MAKA KITA GUNAKAN DIRECTIVE DIBAWAH INI -->
                @method('PUT')

              	<!-- FORM INI SAMA DENGAN CREATE, YANG BERBEDA HANYA ADA TAMBAHKAN VALUE UNTUK MASING-MASING INPUTAN  -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $produk->deskripsi }}</textarea>
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $produk->status == '1' ? 'selected':'' }}>Publish</option>
                                        <option value="0" {{ $produk->status == '0' ? 'selected':'' }}>Draft</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_id">Kategori</label>
                                    <select name="kategori_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $row)
                                        <option value="{{ $row->id }}" {{ $produk->kategori_id == $row->id ? 'selected':'' }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Berat</label>
                                    <input type="number" name="berat" class="form-control" value="{{ $produk->berat }}" required>
                                    <p class="text-danger">{{ $errors->first('berat') }}</p>
                                </div>

                              	<!-- GAMBAR TIDAK LAGI WAJIB, JIKA DIISI MAKA GAMBAR AKAN DIGANTI, JIKA DIBIARKAN KOSONG MAKA GAMBAR TIDAK AKAN DIUPDATE -->
                                <div class="form-group">
                                    <label for="gambar">Foto Produk</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <img src="{{ asset('storage/produks/' . $produk->gambar) }}" width="100px" height="100px" alt="{{ $produk->nama }}">
                                    <hr>
                                    <input type="file" name="gambar" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('gambar') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
@endsection
