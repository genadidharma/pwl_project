@extends('layouts.app')

@section('content')
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
                            <option value="{{$pemeriksaan->id}}">{{$pemeriksaan->no_telp_pemilik_hewan . ' - ' . $pemeriksaan->nama_pemilik_hewan . ' | ' . \Carbon\Carbon::parse($pemeriksaan->jam_pemeriksaan)->format('d M y')}}</option>
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

@isset($list_obat)
<section class="section">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_obat as $index => $obat)
                    <tr>
                        <td>{{$index+=1}}</td>
                        <td>{{$obat->barang->nama}}</td>
                        <td>{{$obat->jumlah}}</td>
                        <td>{{$obat->barang->harga_satuan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{route('transaksi.obat.create')}}" method="post">
                <div class="buttons float-end mt-3">
                    <input type="submit" value="Bayar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</section>
@endisset

@endsection

@push('scripts')
<script src="{{asset('assets/js/extensions/multiform.js')}}"></script>
<script type="text/javascript">
    const rowTemplate = function(i) {
        const template = `
                <tr class="added-row">
                    <td>
                        <div class="row">
                            <div class="col choices-col">
                                <div class="form-group">
                                    <label for="basicInput">Nama Obat <span class="text-danger">*</span></label>
                                    <select class="form-select new-choices" name="obat[${i}][id_barang]" onchange="onChoicesChange(event, this)">

                                    </select>

                                    @error('obat[${i}][id_barang]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="basicInput">Jumlah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn icon btn-secondary btn-number" disabled="disabled" data-type="minus" data-field="obat[${i}][jumlah]" onclick="onBtnNumberClick(event, this)">
                                                <i data-feather="minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" class="form-control input-number @error('jumlah') is-invalid @enderror" id="basicInput" name="obat[${i}][jumlah]" value="1" min="1" max readonly onfocus="onInputNumberFocusIn(this)" onchange="onInputNumberChange(this)" onkeydown="onInputNumberKeydown(event)">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn icon btn-secondary btn-number" data-type="plus" data-field="obat[${i}][jumlah]" onclick="onBtnNumberClick(event, this)">
                                                <i data-feather="plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('obat[0][jumlah]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-link text-danger float-end" onclick="removeItem(this)">Hapus</button>
                    </td>
                </tr>
            `;
        return template;
    };
</script>
@endpush