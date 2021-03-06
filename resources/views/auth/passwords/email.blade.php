@extends('layouts.auth')

@section('title', 'Masukan E-mail')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <img src="{{asset('assets/images/logo/logo-text.png')}}" class="w-50 h-auto" alt="Logo" srcset="">
            </div>
            <h1 class="auth-title">Ubah Password</h1>
            <p class="auth-subtitle mb-5">Masukan alamat E-mailmu untuk Mengubah Password</p>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                    <div class="form-control-icon position-absolute">
                        <i class="bi bi-envelope"></i>
                    </div>

                    @error('email')
                    <span class="invalid-feedback position-absolute" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Kirim</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Masih ingat akunmu? <a href="{{route('login')}}" class="font-bold">Log
                        in</a>.
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
@endsection