@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Transaksi Barang</h3>
                <p class="text-subtitle text-muted">Melakukan Transaksi Barang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a href="{{route('transaksi.barang.index')}}">Transaksi Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Transaksi Barang</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                @if($list_barang->isNotEmpty())
                <form action="{{route('transaksi.barang.store')}}" method="post">
                    @csrf
                    <table class="table table-no-border" id="table">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col choices-col">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Obat <span class="text-danger">*</span></label>
                                            <select class="form-select choices" name="barang[0][id_barang]" onchange="onChoicesChange(event, this)">
                                                @foreach($list_barang as $barang)
                                                <option value='{"id": {{$barang->id}}, "stok": {{$barang->stok_sum_jumlah}}}'>
                                                    <div id="tersedia">{{ $barang->nama . ' - ' . $barang->stok_sum_jumlah . ' tersisa'}}</div>
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('barang[0][id_barang]')
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
                                                    <button type="button" class="btn icon btn-secondary btn-number" disabled="disabled" data-type="minus" data-field="barang[0][jumlah]" onclick="onBtnNumberClick(event, this)">
                                                        <i data-feather="minus"></i>
                                                    </button>
                                                </div>
                                                <input type="number" class="form-control input-number @error('jumlah') is-invalid @enderror" id="basicInput" name="barang[0][jumlah]" value="1" min="1" max="{{$list_barang->first()->stok_sum_jumlah}}" readonly onfocus="onInputNumberFocusIn(this)" onchange="onInputNumberChange(this)" onkeydown="onInputNumberKeydown(event)">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn icon btn-secondary btn-number" data-type="plus" data-field="barang[0][jumlah]" onclick="onBtnNumberClick(event, this)">
                                                        <i data-feather="plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('barang[0][jumlah]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="buttons float-end mt-3">
                        <button type="button" class="btn btn-outline-success" id="add_more" onclick="addMoreClick()">Tambah Barang Lain</button>
                        <input type="submit" class="btn btn-primary" value="Checkout">
                    </div>
                </form>
                @endif
            </div>
        </div>
    </section>
</div>
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
                                <select class="form-select new-choices" name="barang[${i}][id_barang]" onchange="onChoicesChange(event, this)">
                                    @foreach($list_barang as $barang)
                                    <option value='{"id": {{$barang->id}}, "stok": {{$barang->stok_sum_jumlah}}}'>
                                        <div id="tersedia">{{ $barang->nama . ' - ' . $barang->stok_sum_jumlah . ' tersisa'}}</div>
                                    </option>
                                    @endforeach
                                </select>

                                @error('barang[${i}][id_barang]')
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
                                        <button type="button" class="btn icon btn-secondary btn-number" disabled="disabled" data-type="minus" data-field="barang[${i}][jumlah]" onclick="onBtnNumberClick(event, this)">
                                            <i data-feather="minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" class="form-control input-number @error('jumlah') is-invalid @enderror" id="basicInput" name="barang[${i}][jumlah]" value="1" min="1" max readonly onfocus="onInputNumberFocusIn(this)" onchange="onInputNumberChange(this)" onkeydown="onInputNumberKeydown(event)">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn icon btn-secondary btn-number" data-type="plus" data-field="barang[${i}][jumlah]" onclick="onBtnNumberClick(event, this)">
                                            <i data-feather="plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('barang[${i}][jumlah]')
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