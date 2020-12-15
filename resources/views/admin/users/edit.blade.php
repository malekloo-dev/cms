@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('users.index') }}">@lang('messages.users')</a></li>
            <li class="active">@lang('messages.edit') {{ $users->name }}</li>
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

                <form method="post" action="{{ route('users.update', $users->id) }}" class="center-block form-max-width">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">name:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" value="{{ $users->name }}" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">email:</label>
                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" value="{{ $users->email }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Password:</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Password:</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password_confirmation" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success  mat-btn ">@lang('messages.edit')</button>

                </form>
            </div>
        </div>
    </div>

@endsection
