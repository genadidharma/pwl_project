@extends('layout')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dokter</h3>
                <p class="text-subtitle text-muted">Ubah data Dokter</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="{{route('dokter.index')}}">Dokter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Dokter</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="basicInput">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="basicInput" name="nama" placeholder="Masukan Nama">
                    </div>

                    <div class="form-group">
                        <label for="helpInputTop">Email <span class="text-danger">*</span></label>
                        <small class="text-muted">misal:<i>seseorang@example.com</i></small>
                        <input type="email" class="form-control" id="emailInput" name="email" placeholder="Masukan Email">
                    </div>

                    <div class="form-group">
                        <label for="helpInputTop">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="basicInput" name="username" placeholder="Masukan Username">
                    </div>

                    <div class="form-group">
                        <label for="helpInputTop">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="basicInput" name="password" placeholder="Masukan Password">
                    </div>
                    <input type="submit" value="Tambah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection