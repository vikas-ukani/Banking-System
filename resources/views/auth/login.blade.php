@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Login With</label>
                                <div class="col-md-6">
                                    <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="{{ url('login/twitter') }}" class="btn btn-social-icon btn-twitter"><i
                                            class="fa fa-twitter"></i></a>
                                    <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus"><i
                                            class="fa fa-google-plus"></i></a>
                                    <a href="{{ url('login/linkedin') }}" class="btn btn-social-icon btn-linkedin"><i
                                            class="fa fa-linkedin"></i></a>
                                    <a href="{{ url('login/github') }}" class="btn btn-social-icon btn-github"><i
                                            class="fa fa-github"></i></a>
                                    <a href="{{ url('login/bitbucket') }}" class="btn btn-social-icon btn-bitbucket"><i
                                            class="fa fa-bitbucket"></i></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Login with Facebook --}}
                            <div class="container mb-0 flex items-center justify-end mt-2">
                                <a class="btn" href="{{ url('login/facebook') }}"
                                    style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                    Login with Facebook
                                </a>
                            </div>
                            {{-- Login with GitHub --}}
                            <div class="container mb-0 flex items-center justify-end mt-2">
                                <a class="btn" href="{{ url('login/github') }}"
                                    style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                    Login with GitHub
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
