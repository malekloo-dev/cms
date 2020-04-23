@extends('layouts.login')
@section('content')


    <div class="panel">
        <div class="panel-heading text-center text-18">
            <div class="row xxxsmallSpace"></div>

            {{ __('Login') }}

            <div class="row xxxsmallSpace"></div>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">

                    <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') ? old('email') : 'm@m.m' }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" value="{{'12345678'}}" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="control-label" for="remember">
                        <input class="" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit"
                            class="btn btn-danger pull-right mat-btn radius-all btn-block mat-elevation-z">
                        <i class="fa fa-lock"></i> {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link   pull-right" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>


@endsection
