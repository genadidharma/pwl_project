@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Stok</h3>
                <p class="text-subtitle text-muted">Ubah data Stok</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('stok.index')}}">Stok</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Stok</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('stok.update', $stok->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="basicInput">Nama Barang <span class="text-danger">*</span></label>
                        <select class="choices form-select @error('id_barang') is-invalid @enderror" name="id_barang">
                            @foreach($list_barang as $barang)
                            <option value="{{$barang->id}}" {{$stok->id_barang == $barang->id ? 'selected' : ''}}>{{$barang->nama}}</option>
                            @endforeach
                        </select>

                        @error('id_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Jumlah <span class="text-danger">*</span></label>
                        <input type="text" id="number-separator" class="form-control @error('jumlah') is-invalid @enderror" id="basicInput" name="jumlah" placeholder="Masukan Jumlah" value="{{$stok->jumlah}}">

                        @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" value="Ubah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection