@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('role.index') }}">@lang('messages.roles')</a></li>
            <li class="active">{{ $role->name }} @lang('messages.permissions')</li>
        </ul>
        <div>
            <a data-toggle="modal" data-target="#add" class="btn btn-success btn-icon mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add')
            </a>
        </div>

    </div>

    <div class="content-body">
        <div class="panel panel-default  pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.permission')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role->permissions as $item)
                            <tr>
                                <td>{{ $item->name }}</td>

                                <td style="width: 100px !important">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="pull-right" action="{{ route('role.destroy', $item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('role.edit', $item->id) }}"
                                                class="font-full-plus-half-em text-success btn-xs pull-right"
                                                title="@lang('messages.edit')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('messages.permission')</h5>
                </div>
                <form action="{{ route('role.permission.store', $role->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="url" class="col-form-label ">@lang('messages.name'):</label>
                                <input type="text" placeholder="" class="form-control" name="name"
                                    value="{{ old('name') }}" />
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('messages.add')</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
