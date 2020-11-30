@extends('admin.layouts.login')
@section('content')


    <div class="panel">
        <div class="panel-heading text-center text-18">
            <div class="row xxxsmallSpace"></div>

            @lang('messages.login page')

            <div class="row xxxsmallSpace"></div>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">

                    <label for="email" class="control-label">@lang('messages.email')</label>

                    <input id="email" type="email" class="form-control ltr @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') ? old('email') : 'm@m.m' }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">@lang('messages.password')</label>

                    <input id="password" type="password" class="form-control ltr @error('password') is-invalid @enderror"
                           name="password" value="{{'12345678'}}" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <button type="submit"
                            class="btn btn-info pull-right mat-btn  btn-block">
                        <i class="fa fa-lock"></i> @lang('messages.login')
                    </button>

                </div>
            </form>
        </div>
    </div>


@endsection
