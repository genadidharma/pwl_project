@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemeriksaan</h3>
                <p class="text-subtitle text-muted">Tambah data Pemeriksaan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('admin.pemeriksaan.index')}}">Pemeriksaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('admin.pemeriksaan.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="basicInput">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="basicInput" name="tanggal" placeholder="Masukan Tanggal Pemeriksaan" value="{{old('tanggal')}}" min="{{\Carbon\Carbon::parse(\Carbon\Carbon::today())->format('Y-m-d')}}">

                        @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Jam <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('jam') is-invalid @enderror" id="basicInput" name="jam" placeholder="Masukan Jam Pemeriksaan" value="{{old('jam')}}">

                        @error('jam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Nama Pemilik Hewan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control  @error('pemilik-hewan') is-invalid @enderror" id="basicInput" name="pemilik-hewan" placeholder="Masukan Nama Pemilik Hewan" value="{{old('pemilik-hewan')}}">

                        @error('pemilik-hewan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="basicInput">No Telepon <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control  @error('no-telepon') is-invalid @enderror" id="basicInput" name="no-telepon" placeholder="Masukan No Telepon" value="{{old('no-telepon')}}">

                        @error('no-telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Dokter <span class="text-danger">*</span></label>
                        <select class="choices form-select" name="dokter">
                            @foreach($list_dokter as $dokter)
                            <option value="{{$dokter->id}}" {{old('dokter') == $dokter->id ? 'selected' : ''}}>{{$dokter->nama}}</option>
                            @endforeach
                        </select>

                        @error('dokter')
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