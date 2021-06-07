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
                        <p class="fs-6 text-grey">{{\Carbon\Carbon::parse($pemeriksaan->jam_pemeriksaan)->format('D, d M | H:i')}}</p>
                        <h4>{{$pemeriksaan->nama_pemilik_hewan}}</h4>
                        <p class="fs-6 text-grey">{{$pemeriksaan->no_telp_pemilik_hewan}}</p>
                        <div class="buttons">
                            <form action="{{route('dokter.pemeriksaan.update', $pemeriksaan->id)}}" method="post">
                                @csrf
                                @method('PUT')

                                <input type="submit" class="btn btn-primary" id="btn_selesai" value="Selesai">

                                @if($list_obat->isNotEmpty())
                                <button type="button" class="btn btn-outline-success" id="btn_resep_obat" onclick="toggleBtnTambahResepObat(this)">Tambah Resep Obat</a>
                                    @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section {{!$errors->any() ? 'd-none' : '' }}" id="resep_obat">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-lg icon float-end" onclick="swalConfirmMedPrescrip(closeResepObat)"><i class="bi bi-x"></i></button>
                <h4 class="card-title">Tambah Obat</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="{{route('dokter.pemeriksaan.update', $pemeriksaan->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <table class="table table-no-border" id="table">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col choices-col">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Obat <span class="text-danger">*</span></label>
                                            <select class="form-select choices" name="obat[0][id_barang]" onchange="onChoicesChange(event, this)">
                                                @foreach($list_obat as $obat)
                                                <option value='{"id": {{$obat->id}}, "stok": {{$obat->stok_sum_jumlah}}}'>
                                                    <div id="tersedia">{{ $obat->nama . ' - ' . $obat->stok_sum_jumlah . ' tersisa'}}</div>
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('obat[0][id_barang]')
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
                                                    <button type="button" class="btn icon btn-secondary btn-number" disabled="disabled" data-type="minus" data-field="obat[0][jumlah]" onclick="onBtnNumberClick(event, this)">
                                                        <i data-feather="minus"></i>
                                                    </button>
                                                </div>
                                                <input type="number" class="form-control input-number @error('jumlah') is-invalid @enderror" id="basicInput" name="obat[0][jumlah]" value="1" min="1" max="{{$list_obat->first()->stok_sum_jumlah}}" readonly onfocus="onInputNumberFocusIn(this)" onchange="onInputNumberChange(this)" onkeydown="onInputNumberKeydown(event)">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn icon btn-secondary btn-number" data-type="plus" data-field="obat[0][jumlah]" onclick="onBtnNumberClick(event, this)">
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
                            </td>
                        </tr>
                    </table>
                    <div class="buttons float-end mt-3">
                        <button type="button" class="btn btn-outline-success" id="add_more" onclick="addMoreClick()">Tambah Obat Lain</button>
                        <input type="submit" name="submit" value="Selesai" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script src="{{asset('assets/js/extensions/multiform.js')}}"></script>
    <script type="text/javascript">
        var resepObat = document.querySelector('#resep_obat')
        var btnSelesai = document.querySelector('#btn_selesai')
        var btnResepObat = document.querySelector('#btn_resep_obat')

        const rowTemplate = function(i) {
            const template = `
                <tr class="added-row">
                    <td>
                        <div class="row">
                            <div class="col choices-col">
                                <div class="form-group">
                                    <label for="basicInput">Nama Obat <span class="text-danger">*</span></label>
                                    <select class="form-select new-choices" name="obat[${i}][id_barang]" onchange="onChoicesChange(event, this)">
                                        @foreach($list_obat as $obat)
                                        <option value='{"id": {{$obat->id}}, "stok": {{$obat->stok_sum_jumlah}}}'>
                                            <div id="tersedia">{{ $obat->nama . ' - ' . $obat->stok_sum_jumlah . ' tersisa'}}</div>
                                        </option>
                                        @endforeach
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

        function toggleBtnTambahResepObat(el) {
            if (resepObat.classList.contains('d-none')) {
                el.classList.remove('btn-outline-success')
                el.classList.add('btn-outline-danger')
                el.innerHTML = 'Batalkan Resep Obat'

                resepObat.classList.remove('d-none')
                btnSelesai.classList.add('d-none')
            } else {
                swalConfirmMedPrescrip(closeResepObat)
            }
        }

        function closeResepObat() {
            btnResepObat.classList.remove('btn-outline-danger')
            btnResepObat.classList.add('btn-outline-success')
            btnResepObat.innerHTML = 'Tambah Resep Obat'

            resepObat.classList.add('d-none')
            btnSelesai.classList.remove('d-none')
            btnAddMore.classList.remove('d-none')

            let choices = table.querySelector('.choices')
            choices.removeAttribute('aria-disabled')
            choices.classList.remove('is-disabled')

            document.querySelectorAll('.added-row').forEach(e => e.remove())

            index = 0
            items = []
        }
    </script>
    @endpush