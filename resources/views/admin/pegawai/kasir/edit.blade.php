@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kasir</h3>
                <p class="text-subtitle text-muted">Ubah data Kasir</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('kasir.index')}}">Kasir</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Kasir</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('kasir.update', $kasir->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="basicInput">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="basicInput" name="nama" value="{{$kasir->nama}}" placeholder="Masukan Nama">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" value="Tambah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection