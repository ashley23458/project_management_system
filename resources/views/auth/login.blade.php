@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-md-center">{{ __('Login') }}</div>
                <a href="{{ route('google_login')}}" class="btn btn-danger"><i class="fab fa-google"></i> Sign in with <b>Google</b></a>
                <div class="divider"><i>Or</i></div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" value="Login" class="col-md-12 btn btn-secondary" />
                    </div>


                    <div class="form-group row justify-content-center">
                            <p>@if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a> |
                            @endif
                            <a class="btn btn-link" href="{{ route('register') }}"> {{ __('Register now') }} </a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <p></p>
</div>
@endsection
