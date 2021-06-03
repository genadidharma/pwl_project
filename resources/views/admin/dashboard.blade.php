@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Statistik Pethouse</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldUser"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Pegawai</h6>
                                    <h6 class="font-extrabold mb-0">{{$list_jumlah->jumlah_pegawai}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldFolder"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kategori Barang</h6>
                                    <h6 class="font-extrabold mb-0">{{$list_jumlah->jumlah_kategori_barang}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Barang</h6>
                                    <h6 class="font-extrabold mb-0">{{$list_jumlah->jumlah_barang}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Stok</h6>
                                    <h6 class="font-extrabold mb-0">{{$list_jumlah->jumlah_stok}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="/assets/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{auth()->user()->nama}}</h5>
                            <h6 class="text-muted mb-0">{{ '@'.auth()->user()->username}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Transaksi Penjualan</h4>
                </div>
                <div class="card-body">
                    <div id="chart-profile-visit"></div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="page-heading">
    <h3>Laporan</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h4>Laporan Penjualan</h4>
                    <a href="#" class="btn btn-danger ms-auto m-3"> <i class="icon-mid bi-file-earmark-arrow-down"></i> Download PDF</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table2">
                            <thead>
                                <tr>
                                    <th>Kasir</th>
                                    <th>Barang</th>
                                    <th>Total Harga(Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="assets/images/faces/5.jpg">
                                            </div>
                                            <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class=" mb-0">Congratulations on your graduation!</p>
                                    </td>
                                    <td class="col-3">
                                        <p class=" mb-0">20000</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h4>Laporan Pemeriksaan</h4>
                    <a href="#" class="btn btn-danger ms-auto m-3"> <i class="icon-mid bi-file-earmark-arrow-down"></i> Download PDF</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table2">
                            <thead>
                                <tr>
                                    <th>Dokter</th>
                                    <th>Pemilik Hewan</th>
                                    <th>Tanggal Periksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="assets/images/faces/5.jpg">
                                            </div>
                                            <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class=" mb-0">Congratulations on your graduation!</p>
                                    </td>
                                    <td class="col-3">
                                        <p class=" mb-0">20000</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection