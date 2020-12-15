@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('users.index')}}">@lang('messages.users')</a></li>
            <li class="active">{{ __('Register') }}</li>
        </ul>


    </div>
    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}" class="center-block form-max-width">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                               class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                            
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 pull-right">
                            <button type="submit"
                                    class="btn btn-success btn-block pull-right mat-btn ">
                                {{ __('Register') }}
                            </button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
