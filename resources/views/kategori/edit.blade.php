@extends('layouts.admin')

@section('title')
    <title>Edit Kategori</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Kategori</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Kategori</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Kategori</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($parent as $row)

                                      	<!-- TERDAPAT TERNARY OPERATOR UNTUK MENGECEK JIKA PARENT_ID SAMA DENGAN ID CATEGORY PADA LIST PARENT, MAKA OTOMATIS SELECTED -->
                                        <option value="{{ $row->id }}" {{ $kategori->parent_id == $row->id ? 'selected':'' }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
