@extends('auth.layouts.app')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                    {{-- <img class="col-lg-6 d-none d-lg-block" src="{{ asset('/img/tiger.png') }}" alt=""> --}}
                    <img class="col-lg-6 d-none d-lg-block" src="{{ asset('/img/white.jpg') }}" alt="">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">歡迎回來!</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('記住帳號') }}
                                    </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    登入
                                </button>
                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('password.request')}}">忘記密碼?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{('register')}}">註冊帳號!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
