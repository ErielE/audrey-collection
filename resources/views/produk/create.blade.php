@extends('layouts.admin')

@section('title')
    <title>Tambah Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

          	<!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="deskripsi" id="description" class="form-control">{{ old('deskripsi') }}</textarea>
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
                                        <option value="1" {{ old('status') == '1' ? 'selected':'' }}>Publish</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected':'' }}>Draft</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_id">Kategori</label>

                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="kategori_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $row)
                                        <option value="{{ $row->id }}" {{ old('kategori_id') == $row->id ? 'selected':'' }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
                                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="number" name="berat" class="form-control" value="{{ old('berat') }}" required>
                                    <p class="text-danger">{{ $errors->first('berat') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="image">Foto Produk</label>
                                    <input type="file" name="gambar" class="form-control" value="{{ old('gambar') }}" required>
                                    <p class="text-danger">{{ $errors->first('gambar') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
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

<!-- PADA ADMIN LAYOUTS, TERDAPAT YIELD JS YANG BERARTI KITA BISA MEMBUAT SECTION JS UNTUK MENAMBAHKAN SCRIPT JS JIKA DIPERLUKAN -->
@section('js')
    <!-- LOAD CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
        CKEDITOR.replace('description');
    </script>
@endsection
