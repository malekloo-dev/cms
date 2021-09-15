@extends('admin.layouts.login')
@section('content')


    <div class="panel">
        <div class="panel-heading text-center text-18">
            <div class="row xxxsmallSpace"></div>

            @lang('messages.login page')

            <div class="row xxxsmallSpace"></div>
        </div>

        <div class="panel-body @if($ltr) ltr @endif" >
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">

                    <label for="mobile" class="control-label">@lang('messages.mobile')</label>

                    <input id="mobile" type="mobile" class="form-control ltr @error('mobile') is-invalid @enderror"
                           name="mobile" value="{{ old('mobile') ? old('mobile') : '' }}" required autocomplete="mobile" autofocus>

                    @error('mobile')
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
