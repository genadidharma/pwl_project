@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kategori Barang</h3>
                <p class="text-subtitle text-muted">Mengatur data Kategori Barang disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori Barang</li>
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

            <a href="{{route('kategori-barang.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th width="80%">Nama</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_kategori_barang as $index => $kategori_barang)
                        <tr>
                            <td>{{$index += 1}}</td>
                            <td>{{$kategori_barang->nama}}</td>
                            <td>
                                <form action="{{route('kategori-barang.destroy', $kategori_barang->id)}}" method="post">
                                    <a href="{{route('kategori-barang.edit', $kategori_barang->id)}}" class="btn-sm btn-warning">Ubah</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-outline-danger border-0" onclick="swalConfirm(event, this)">Hapus</button>
                                </form>
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