@extends('layouts.login')

@section('content')
    <div class="panel">
        <div class="panel-heading text-center text-18">
            <div class="row xxxsmallSpace"></div>

            {{ __('Reset Password') }}

            <div class="row xxxsmallSpace"></div>
        </div>

        <div class="panel-body">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <span class="text-danger mb-2">
                         @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </span>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        </div>

                        <div class="form-group row mt-5 ">
                            <div class="btn btn-block" >
                                <button type="submit" class="btn btn-info  mat-btn radius-all  mat-elevation-z">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
