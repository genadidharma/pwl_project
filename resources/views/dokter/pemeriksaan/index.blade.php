@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemeriksaan Hari Ini</h3>
                <p class="text-subtitle text-muted">Mengatur Pemeriksaan Pasien disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Pemeriksaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @isset($pasien_berikutnya)
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Pasien Berikutnya</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <img class="avatar w-100" src="{{asset('assets/images/faces/2.jpg')}}">
                    </div>
                    <div class="col-11">
                        <p class="fs-6 text-grey">{{\Carbon\Carbon::parse($pasien_berikutnya->jam_pemeriksaan)->format('D, d M | H:i')}}</p>
                        <h4>{{$pasien_berikutnya->nama_pemilik_hewan}}</h4>
                        <p class="fs-6 text-grey">{{$pasien_berikutnya->no_telp_pemilik_hewan}}</p>
                        <div class="col-2">
                            <a href="{{route('dokter.pemeriksaan.show', $pasien_berikutnya->id)}}" class="btn btn-md btn-primary">Periksa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endisset
    <section class="section">
        <div class="card">
            @if(session('message'))
            <script>
                toast('{{session("error")}}', '{{session("message")}}')
            </script>
            @endif
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Pemilik Hewan</th>
                            <th>No Telepon</th>
                            <th>Nama Dokter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_pemeriksaan as $index => $pemeriksaan)
                        <tr>
                            <td>{{$index += 1}}</td>
                            <td>{{Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d M Y')}}</td>
                            <td>{{$pemeriksaan->jam_pemeriksaan}}</td>
                            <td>{{$pemeriksaan->nama_pemilik_hewan}}</td>
                            <td>{{$pemeriksaan->no_telp_pemilik_hewan}}</td>
                            <td>{{$pemeriksaan->user->nama}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection