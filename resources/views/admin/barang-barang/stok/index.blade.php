@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Stok</h3>
                <p class="text-subtitle text-muted">Mengatur data Stok disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Stok</li>
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

            <a href="{{route('stok.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="50%">Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal Masuk</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_stok as $stok)
                        <tr>
                            <td>
                                <div class="avatar avatar-lg me-1">
                                    <img src="{{asset('storage/' . $stok->barang->gambar)}}" alt="{{$stok->nama}}">
                                </div>
                                {{$stok->barang->nama}}
                            </td>
                            <td><b>{{$stok->barang->kategori->nama}}</b></td>
                            <td>{{$stok->jumlah}}</td>
                            <td>{{Carbon\Carbon::parse($stok->created_at)->format('d M Y')}}</td>
                            <td>
                                <form action="{{route('stok.destroy', $stok->id)}}" method="post">
                                    <a href="{{route('stok.edit', $stok->id)}}" class="btn-sm btn-warning">Ubah</a>
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