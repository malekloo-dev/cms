@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">
                @lang('messages.order detail')
                {{ convertGtoJ($order->created_at) }} - {{ $order->user->mobile }}


            </li>
        </ul>
        <div style="display:flex; gap:1em;">
            <form method="post" action="{{ route('admin.order.edit', $order) }}">
                @csrf
                @method('patch')
                <input type="hidden" name="status" value="2">
                <button href="" class=" btn btn-success btn-icon  mat-button ">
                    <i class="fa fa-check"></i>@lang('messages.confirm')
                </button>
            </form>
            <form method="post" action="{{ route('admin.order.edit', $order) }}">
                @csrf
                @method('patch')
                <input type="hidden" name="status" value="-1">
                <button href="" class=" btn btn-danger btn-icon  mat-button ">
                    <i class="fa fa-remove"></i>@lang('messages.unconfirm')
                </button>
            </form>

        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if ($order->status == 2)
                    <div class="alert alert-success">
                        @lang('messages.confirm')
                    </div>
                @elseif ($order->status == -1)
                    <div class="alert alert-warning">
                        @lang('messages.unconfirm')
                    </div>
                @else
                    @lang('messages.order insert')
                @endif
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
                            <th>@lang('messages.image')</th>
                            <th>@lang('messages.title')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.updated at')</th>
                            <th>@lang('messages.created at')</th>
                            <th width="50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>

                                    @if (isset($item['attributes']['image']) && file_exists(public_path() . $item['attributes']['image']))
                                        <img src="{{ $item->attributes['image'] }}" alt="">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="">{{ $item->title ?? '' }}</td>
                                <td>
                                    @if ($item->status == 2)
                                        <i class="fa fa-check"></i>
                                    @elseif ($item->status == 1)
                                        در حال بررسی
                                    @else
                                        ثبت شده
                                    @endif
                                </td>
                                <td class="">{{ convertGToJ($item->updated_at, $time = true) }}</td>
                                <td class="">{{ convertGToJ($item->created_at, true) }} </td>
                                <td>
                                    <div class="">
                                        <div class="">
                                            <form class="pull-right" action="{{ route('admin.order.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
