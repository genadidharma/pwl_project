@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang</h3>
                <p class="text-subtitle text-muted">Tambah data Barang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('barang.index')}}">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Barang</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('barang.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="basicInput">Kategori <span class="text-danger">*</span></label>
                        <select class="choices form-select" name="id_kategori_barang">
                            @foreach($list_kategori_barang as $kategori_barang)
                            <option value="{{$kategori_barang->id}}" {{old('id_kategori_barang') == $kategori_barang->id ? 'selected' : ''}}>{{$kategori_barang->nama}}</option>
                            @endforeach
                        </select>

                        @error('id_kategori_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="basicInput" name="nama" placeholder="Masukan Nama" value="{{old('nama')}}">

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Gambar <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" image-crop-aspect-ratio="1:1" name="gambar" value="{{old('gambar')}}">

                        @error('gambar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Harga Satuan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control @error('harga_satuan') is-invalid @enderror" placeholder="Masukan Harga Satuan" id="basicInput" name="harga_satuan" value="{{old('harga_satuan')}}">

                            @error('harga_satuan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" value="Tambah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection