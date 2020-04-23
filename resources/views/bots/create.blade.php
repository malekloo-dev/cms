@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a class="text-18">{{ __('Create New Bot') }}</a></li>
        </ul>


    </div>
    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <form method="POST" action="{{ route('bots.store') }}" class="center-block form-max-width">
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

                    <div class="form-group row mb-0">
                        <div class="col-md-12 pull-right">
                            <button type="submit"
                                    class="btn btn-success  pull-right mat-btn radius-all  mat-elevation-z">
                                {{ __('Submit') }}
                            </button>
                            <a href="{{ route('bots.index') }}" class="link ">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection