@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemeriksaan</h3>
                <p class="text-subtitle text-muted">Mengatur Pemeriksaan Dokter disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dokter.pemeriksaan.index')}}">Pemeriksaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemeriksaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Pasien</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <img class="avatar w-100" src="{{asset('assets/images/faces/2.jpg')}}">
                    </div>
                    <div class="col-11">
                        <p class="fs-6 text-grey">{{\Carbon\Carbon::parse($pasien->jam_pemeriksaan)->format('D, d M | H:i')}}</p>
                        <h4>{{$pasien->nama_pemilik_hewan}}</h4>
                        <p class="fs-6 text-grey">{{$pasien->no_telp_pemilik_hewan}}</p>
                        <div class="buttons">
                            <form action="{{route('dokter.pemeriksaan.update', $pasien->id)}}" method="post">
                                @csrf
                                @method('PUT')

                                <input type="submit" class="btn btn-primary" id="btn_selesai" value="Selesai">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection