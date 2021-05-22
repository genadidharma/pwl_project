@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang</h3>
                <p class="text-subtitle text-muted">Mengatur data Barang disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <a href="{{route('barang.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="50%">Nama</th>
                            <th>Kategori</th>
                            <th>Harga Satuan(Rp)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="avatar avatar-lg me-1">
                                    <img src="{{asset('assets/images/faces/1.jpg')}}" alt="" srcset="">
                                </div>
                                Graiden
                            </td>
                            <td><b>Obat</b></td>
                            <td>20.000</td>
                            <td>
                                <a href="#" class="btn-sm btn-warning">Ubah</a>
                                <a href="#" class="btn-sm btn-outline-danger">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection