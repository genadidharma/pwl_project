@extends('layouts.auth')

@section('title', 'Ubah Password')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Ubah Password</h1>
            <p class="auth-subtitle mb-5">Ganti Passwordmu dengan yang baru</p>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}"">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group position-relative has-icon-left mb-4 @error('email') mb-5 @enderror">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="E-mail">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    @error('email')
                    <span class="invalid-feedback position-absolute" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4  @error('password') mb-5 @enderror">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus placeholder="Password Baru">
                    <div class="form-control-icon">
                        <i class="bi bi-lock"></i>
                    </div>

                    @error('password')
                    <span class="invalid-feedback position-absolute" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group position-relative has-icon-left mb-4 @error('password_confirmation') mb-5 @enderror">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                    <div class="form-control-icon">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ubah</button>
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