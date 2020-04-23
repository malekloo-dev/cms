@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a  class="text-18">Edit {{ $users->name }} </a></li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                        <form method="post" action="{{ route('users.update', $users->id) }}">
                            @method('PATCH')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">name:</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name"  value="{{ $users->name }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">email:</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email"  value="{{ $users->email }}" />
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">Password:</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">Password:</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password_confirmation" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">changePassword</button>
                            <a href="{{ route('users.index') }}" class="link ">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </form>
            </div>
        </div>
    </div>

@endsection