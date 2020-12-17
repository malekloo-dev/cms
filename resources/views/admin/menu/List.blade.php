@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.menu')</li>
        </ul>
        <div>
            <a href="{{ route('menu.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add')
            </a>

        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
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
                            <th></th>
                            <th>@lang('messages.title')</th>
                            <th>@lang('messages.link')</th>
                            <th>@lang('messages.module')</th>
                            <th>@lang('messages.type')</th>
                            <th>@lang('messages.sort')</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{!! $menu->symbol . $menu->label !!}</td>
                                <td>{{ url($menu->link) }}</td>
                                <td>{{ $menu->module }}</td>
                                <td>{{ $menu->type }}</td>
                                <td>{{ $menu->sort }}</td>

                                <td class="width-100">
                                    <div class="col-md-6">

                                        <form class=" line-height-30" action="{{ route('menu.destroy', $menu->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                type="submit" title="@lang('messages.delete')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">

                                        <a href="{{ route('menu.edit', $menu->id) }}"
                                            class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30"
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

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif--}}
