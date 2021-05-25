@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dokter</h3>
                <p class="text-subtitle text-muted">Mengatur data Dokter disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dokter</li>
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
            <a href="{{route('dokter.create')}}" class="btn btn-primary ms-auto m-3">Tambah</a>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dokter)                    
                        <tr>
                            <td>{{$dokter->nama}}</td>
                            <td>{{$dokter->email}}</td>
                            <td>{{$dokter->username}}</td>
                            <td>
                                
                                <form action="{{route('dokter.destroy', $dokter->id)}}" method="post">
                                    <a href="{{route('dokter.edit', $dokter->id)}}" class="btn-sm btn-warning">Ubah</a>
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