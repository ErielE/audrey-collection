@extends('layouts.admin')

@section('title')
    <title>List Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                List Produk
                                <div class="float-right">
                                    <a href="{{ route('produk.bulk') }}" class="btn btn-danger btn-sm">Mass Upload</a>
                                    <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <!-- BUAT FORM UNTUK PENCARIAN, METHODNYA ADALAH GET -->
                            <form action="{{ route('produk.index') }}" method="get">
                                <div class="input-group mb-3 col-md-3 float-right">
                                    <!-- KEMUDIAN NAME-NYA ADALAH Q YANG AKAN MENAMPUNG DATA PENCARIAN -->
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produk as $row)
                                        <tr>
                                            <td>
                                                <!-- TAMPILKAN GAMBAR DARI FOLDER PUBLIC/STORAGE/PRODUkS -->
                                                <img src="{{ asset('storage/produks/' . $row->gambar) }}" width="100px" height="100px" alt="{{ $row->nama }}">
                                            </td>
                                            <td>
                                                <strong>{{ $row->nama }}</strong><br>
                                                <label>Kategori: <span class="badge badge-info">{{ $row->kategori->nama}}</span></label><br>
                                                <label>Berat: <span class="badge badge-info">{{ $row->berat }} gr</span></label>
                                            </td>
                                            <td>Rp {{ number_format($row->harga) }}</td>
                                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                            <td>{!! $row->status_label !!}</td>
                                            <td>
                                                <form action="{{ route('produk.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('produk.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $produk->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
