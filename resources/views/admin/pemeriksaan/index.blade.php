@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pemeriksaan</h3>
                <p class="text-subtitle text-muted">Mengatur data Pemeriksaan Pasien Ke Dokter</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemeriksaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            @if(session('message'))
            <script>
                toast('{{session("error")}}', '{{session("message")}}')
            </script>
            @endif
            <a href="{{route('admin.pemeriksaan.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_pemeriksaan as $index=>$pemeriksaan) 
                        <tr>
                            <td>{{$index+=1}}</td>
                            <td>{{Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d M Y')}}</td>
                            <td>{{$pemeriksaan->jam_pemeriksaan}}</td>
                            <td>{{$pemeriksaan->nama_pemilik_hewan}}</td>
                            <td>{{$pemeriksaan->no_telp_pemilik_hewan}}</td>
                            <td>{{$pemeriksaan->user->nama}}</td>
                            <td>
                                @if ($pemeriksaan->status == 1)
                                    {{'Terdaftar'}}
                                @elseif ($pemeriksaan->status == 2)
                                    {{'Dalam Pemeriksaan'}}
                                @elseif ($pemeriksaan->status == 3)
                                    {{'Selesai'}}
                                @endif
                            </td>
                            <td>                                
                                @if ($pemeriksaan->status == 1)
                                <form action="{{route('admin.pemeriksaan.destroy', $pemeriksaan->id)}}" method="post">
                                    <a href="{{route('admin.pemeriksaan.edit', $pemeriksaan->id)}}" class="btn-sm btn-warning">Ubah</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-outline-danger border-0" onclick="swalConfirm(event, this)">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection