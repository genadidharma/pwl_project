@extends('layouts.app')

@section('content')

@if($list_pemeriksaan->isNotEmpty())
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Tebus Resep Obat</h4>
        </div>
        <div class="card-body">
            <form action="{{route('transaksi.obat.create')}}" method="get" role="search">
                <div class="form-group">
                    <label for="basicInput">Pemeriksaan <span class="text-danger">*</span></label>
                    <select class="form-select choices" name="id_pemeriksaan">
                        @isset($list_pemeriksaan)
                        @foreach($list_pemeriksaan as $pemeriksaan)
                        <option value="{{$pemeriksaan->id}}" {{old('id_pemeriksaan') == $pemeriksaan->id || request()->query('id_pemeriksaan') == $pemeriksaan->id ? 'selected' : ''}}>{{\Carbon\Carbon::parse($pemeriksaan->tanggal_pemeriksaan)->format('d M y') . ' | ' . $pemeriksaan->no_telp_pemilik_hewan . ' - ' . $pemeriksaan->nama_pemilik_hewan}}</option>
                        @endforeach
                        @endisset
                    </select>

                    @error('id_pemeriksaan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="buttons float-end mt-3">
                    <input type="submit" value="Tampilkan Obat" class="btn btn-outline-success">
                </div>
            </form>
        </div>
    </div>
</section>
@else
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img width="300px" src="{{asset('assets/images/samples/error-404.png')}}" alt="Not Found">
                <h5>Belum ada Obat yang harus Ditebus Hari Ini</h5>
                <p>Tunggu dokter melakukan pemeriksaan</p>
            </div>
        </div>
    </div>
</section>
@endif

@if($list_obat->isNotEmpty())
<section class="section">
    <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Resep Obat</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="50%">Nama</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan(Rp)</th>
                                <th>Total (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_obat as $index => $obat)
                            <tr>
                                <td>{{$index+=1}}</td>
                                <td>{{$obat->nama}}</td>
                                <td>{{$obat->jumlah}}</td>
                                <td>@idr($obat->harga_satuan)</td>
                                <td>@idr($obat->total)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary float-end mt-3" data-bs-toggle="modal" data-bs-target="#pembayaranForm">Bayar</button>
                    <div class="modal fade text-left" id="pembayaranForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Ringkasan Pembayaran</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <p>Total Transaksi</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-end">@idr($list_obat->sum('harga_satuan') * $list_obat->sum('jumlah'))</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p>PPN(10%)</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-end">@idr($list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1)</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-light">
                                            <div class="row">
                                                <div class="col">
                                                    <p>Total Biaya</p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-5 fw-bold text-end">@idr($list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')+$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('transaksi.obat.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="basicInput">Uang <span class="text-danger">*</span></label>
                                            <input type="text" id="number-separator" class="form-control input-number @error('uang') is-invalid @enderror" id="basicInput" name="uang" placeholder="Masukan Uang">
                                            @error('uang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <input type="hidden" name="total_transaksi" value="{{$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')}}">
                                            <input type="hidden" name="total_ppn" value="{{$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1}}">
                                            <input type="hidden" name="total_harga" value="{{$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')+$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1}}">
                                            <input type="hidden" name="id_pemeriksaan" value="{{request()->query('id_pemeriksaan')}}">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="submit" value="Bayar" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <p class="text-end">@idr($list_obat->sum('harga_satuan')*$list_obat->sum('jumlah'))</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>PPN(10%)</p>
                        </div>
                        <div class="col">
                            <p class="text-end">@idr($list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1)</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            <p>Total Biaya</p>
                        </div>
                        <div class="col">
                            <p class="fs-5 fw-bold text-end">@idr($list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')+$list_obat->sum('harga_satuan')*$list_obat->sum('jumlah')*0.1)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
@if ($errors->any())
<script>
    $(window).on('load', function() {
        $('#pembayaranForm').modal('show')
    })
</script>
@endif
@endpush