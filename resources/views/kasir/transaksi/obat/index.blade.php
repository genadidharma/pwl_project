@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transaksi Obat</h3>
                <p class="text-subtitle text-muted">Mengatur Transaksi Obat</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Transaksi Obat</li>
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
            <a href="{{route('transaksi.obat.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Total Harga(Rp)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_transaksi_obat as $index=>$transaksi)
                            <tr>
                                <td>{{$index+=1}}</td>
                                <td>{{Carbon\Carbon::parse($transaksi->created_at)->format('D, d M')}}</td>
                                <td>{{$transaksi->user->nama}}</td>
                                <td>@idr($transaksi->total_harga+$transaksi->total_ppn)</td>
                                <td>
                                    <a href="{{route('transaksi.obat.show', $transaksi->id)}}" class="btn-sm btn-danger">Lihat Struk</a>
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