@extends('layout')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang</h3>
                <p class="text-subtitle text-muted">Ubah data Barang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"> <a href="index.html">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Barang</h4>
                <p><span class="text-danger">*</span> Wajib diisi</p>
            </div>

            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="basicInput">Kategori <span class="text-danger">*</span></label>
                        <select class="choices form-select">
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="basicInput" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Gambar</label>
                        <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Harga Satuan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control" placeholder="Masukan Harga Satuan" id="basicInput" name="harga">
                        </div>
                    </div>
                    <input type="submit" value="Ubah" class="btn btn-primary float-end mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection