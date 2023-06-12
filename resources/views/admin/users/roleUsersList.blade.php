@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('role.index') }}">@lang('messages.role')</a></li>
            <li class="active">{{ $role->name }} @lang('messages.users')</li>
        </ul>
        <div>
            <a href="{{ route('role.users.assign', $role->id) }}" data-toggle="modal" data-target="#add"
                class="btn btn-success btn-icon mat-button ">
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

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.user')</th>
                            <th>@lang('messages.mobile')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role->users()->orderBy('id','desc')->get() as $item)
                            <tr>
                                <td>{{ $item->name ??  $item?->customer?->name ?? ''}} </td>
                                <td>{{ $item->mobile }}</td>

                                <td>{{ $item->customer?->address }}  - {{ $item->customer?->zipcode }}</td>

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


    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('messages.user')</h5>
                </div>
                <div class="modal-body">
                    <select name="" id="" class="select2">
                        @foreach ($allUsers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
