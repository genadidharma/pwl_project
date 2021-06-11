@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<section class="section">
    <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Barang</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="50%">Nama</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan(Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
                                                    <p>Total Biaya</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-end">250.000</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p>PPN(10%)</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-end">30.000</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer bg-light">
                                            <div class="row">
                                                <div class="col">
                                                    <p>Total Biaya</p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-5 fw-bold text-end">250.000</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('transaksi.barang.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="basicInput">Uang <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control input-number @error('jumlah') is-invalid @enderror" id="basicInput" name="uang" placeholder="Masukan Uang">
                                            @error('uang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="bayar" value="Bayar" class="btn btn-primary">
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
                            <p class="text-end">250.000</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>PPN(10%)</p>
                        </div>
                        <div class="col">
                            <p class="text-end">30.000</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            <p>Total Biaya</p>
                        </div>
                        <div class="col">
                            <p class="fs-5 fw-bold text-end">250.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection