@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-between">
                    <h4 class="align-self-center">Daftar Barang</h4>
                    <a href="{{route('transaksi.barang.show',['barang'=>$transaksi->id,'print'=>'true'])}}" class="btn btn-danger ms-auto m-3"> <i class="icon-mid bi-file-earmark-arrow-down"></i> Cetak PDF</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="50%">Nama</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan(Rp)</th>
                                <th>Total(Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->barang as $index=>$barang)
                            <tr>
                                <td>{{$index+=1}}</td>
                                <td>{{$barang->nama}}</td>
                                <td>{{$barang->pivot->jumlah}}</td>
                                <td>@idr($barang->harga_satuan)</td>
                                <td>@idr($barang->total)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    <h4>Ringkasan Pembayaran</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p>Total Transaksi</p>
                        </div>
                        <div class="col">
                            <p class="text-end">@idr_sign($transaksi->total_harga)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>PPN(10%)</p>
                        </div>
                        <div class="col">
                            <p class="text-end">@idr_sign($transaksi->total_ppn)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Total Biaya</p>
                        </div>
                        <div class="col">
                            <p class="fw-bold text-end">@idr_sign($transaksi->total_harga+$transaksi->total_ppn)</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            <p>Uang</p>
                        </div>
                        <div class="col">
                            <p class="fw-bold text-end">@idr_sign($transaksi->uang)</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Kembalian</p>
                        </div>
                        <div class="col">
                            <p class="fw-bold text-end">@idr_sign($transaksi->uang-($transaksi->total_harga+$transaksi->total_ppn))</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection