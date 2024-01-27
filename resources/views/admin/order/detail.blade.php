@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">
                @lang('messages.order detail')
                {{ convertGtoJ($order->created_at) }}




            </li>
        </ul>
        <div style="display:flex; gap:1em;">


            @if ($order->status != 3)
                <form method="post" action="{{ route('admin.order.edit', $order) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="status" value="3">
                    <button href="" class=" btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-check"></i>@lang('messages.paid successfully')
                    </button>
                </form>
            @endif

            @if ($order->status != -1)
                <form method="post" action="{{ route('admin.order.edit', $order) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="status" value="-1">
                    <button href="" class=" btn btn-danger btn-icon  mat-button ">
                        <i class="fa fa-remove"></i>@lang('messages.unconfirm')
                    </button>
                </form>
            @endif

        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                {{ $order->user->mobile }} <br>
                {{ $order->user->customer->name ?? ''}} {{ $order->user->customer->family ?? '' }} <br>
                {{ $order->user->customer?->address }} - کد پستی: {{ $order->user->customer?->zipcode }}
                <br>
                <br>
                @if ($order->status == 5)
                    <div class="alert alert-success">
                        @lang('messages.ready to send')
                    </div>
                @elseif ($order->status == 4)
                    <div class="alert alert-success">
                        @lang('messages.prepairing')
                    </div>
                @elseif ($order->status == 3)
                    <div class="alert alert-success">
                        وضعیت: @lang('messages.paid successfully')
                    </div>
                @elseif ($order->status == 2)
                    <div class="alert alert-warning">
                        وضعیت: فیش آپلود شده<br><br>
                        <div style="font-weight:bold">
                            مبلغ کل @convertCurrency($order->total_price) @lang('messages.toman')
                        </div>
                        <br>

                    </div>
                @elseif ($order->status == -1)
                    <div class="alert alert-warning">
                        @lang('messages.unconfirm')
                    </div>
                @else
                    @lang('messages.order insert')
                @endif
                <br>

                @if (count($transactions))
                    @foreach ($transactions as $item)
                        @if (strpos($item->description, 'upload'))
                            <div class="" style="display:flex; align-items: center; gap:1em">

                                <a class="btn btn-info" href="{{ url($item->description) }}">دانلود فیش :
                                    {{ convertGtoJ($item->created_at) }}
                                    وضعیت:
                                    @if ($item->status == 3)
                                        آپلود شده
                                    @elseif($item->status == 2)
                                        تایید شده
                                    @elseif($item->status == -1)
                                        رد شده
                                    @endif

                                </a>
                                @if ($item->status != 2)
                                    <form method="post" action="{{ route('admin.transaction.edit', $item) }}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" value="2" name="status">
                                        <button href="" class=" btn  btn-success btn-icon  mat-button ">
                                            <i class="fa fa-remove"></i>تایید پرداخت
                                        </button>
                                    </form>
                                @endif
                                @if ($item->status != -1)
                                    <form method="post" action="{{ route('admin.transaction.edit', $item) }}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" value="-1" name="status">
                                        <button href="" class=" btn  btn-danger btn-icon  mat-button ">
                                            <i class="fa fa-remove"></i>عدم واریزی
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endforeach
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
                                        <a target="__blank"
                                            href="{{ url(\App\Models\Content::find($item->attributes['product_id'])->slug) }}">
                                            <img src="{{ $item->attributes['image'] }}" alt="">
                                        </a>
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
                                            <form class="pull-right" action="{{ route('admin.order.destroy', $item) }}"
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
