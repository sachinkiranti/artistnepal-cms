@extends('admin.auth.auth')

@section('title', 'Login')

@push('css')
    <style>
        .logo {
            width: 58%;
            margin: 5px;
            height: 30%;
        }
    </style>
@endpush

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <img class="logo" alt="image" src="{{ asset('dist/themes/artist-nepal/img/logo.svg') }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary block full-width m-b">
                                        {{ __('Login') }}
                                    </button>

                                    <div class="text-center mb-2">

                                        <b>CMS v1 © {{ date('Y') }} — Powered by innovation</b>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
