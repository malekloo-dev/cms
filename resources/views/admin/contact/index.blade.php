@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.contact')</li>
        </ul>


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
                            <th>@lang('messages.name')</th>
                            <th>@lang('messages.lastname')</th>
                            <th>@lang('messages.contact')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.date')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="">{{ $item->name ?? '' }}</td>
                                <td class="">{{ $item->lastname ?? '' }}</td>
                                <td class="">{!! $item->comment !!}</td>
                                <td class="">
                                    @if ($item->status == 1)
                                        <i class="fa fa-check"></i>
                                    @endif

                                </td>
                                <td class="">{{ $item->created_at }}</td>

                                <td class="width-100">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <form class="pull-right" action="{{ route('contact.destroy', $item->id) }}"
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
                                        <div class="col-xs-6">
                                            <a href="{{ route('contact.edit', $item->id) }}"
                                                class="font-full-plus-half-em text-success btn-xs pull-right"
                                                title="@lang('messages.edit')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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