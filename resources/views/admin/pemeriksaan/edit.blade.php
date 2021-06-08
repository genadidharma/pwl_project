@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemeriksaan</h3>
                <p class="text-subtitle text-muted">Ubah data Pemeriksaan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('admin.pemeriksaan.index')}}">Pemeriksaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Data Pemeriksaan</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('admin.pemeriksaan.update', $pemeriksaan->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="basicInput">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="basicInput" name="tanggal" value="{{\Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('Y-m-d')}}" placeholder="Masukan Tanggal Pemeriksaan">
                        @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Jam <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('jam') is-invalid @enderror" id="basicInput" name="jam" value="{{\Carbon\Carbon::parse($pemeriksaan->jam_pemeriksaan)->format('H:i:s')}}" placeholder="Masukan Jam Pemeriksaan">
                        @error('jam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="hidden" name="dokter" value="{{$pemeriksaan->id_user}}">
                    <input type="submit" value="Ubah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection