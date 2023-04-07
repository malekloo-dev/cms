@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.order')</li>
        </ul>
        <div>
            <a href="{{ route('admin.company.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i>@lang('messages.add')
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
                            <th>@lang('messages.mobile')</th>
                            <th>@lang('messages.total price')</th>
                            <th>@lang('messages.status')</th>

                            <th>@lang('messages.updated at')</th>
                            <th>@lang('messages.created at')</th>
                            <th width="150"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="">{{ $item->user->mobile ?? '' }}</td>
                                <td style="font-weight:bold">

                                    @convertCurrency($item->total_price) @lang('messages.toman')

                                    @foreach ($item->orderDetail as $item2)
                                        @if (isset($item2['attributes']['image']) && file_exists(public_path() . $item2['attributes']['image']))
                                            <img height="40" style="border:1px solid #ccc"
                                                src="{{ $item2->attributes['image'] }}" alt="">
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @if ($item->status == 5)
                                        @lang('messages.ready to send')
                                    @elseif ($item->status == 4)
                                        @lang('messages.prepairing')

                                    @elseif ($item->status == 3)
                                        @lang('messages.paid successfully')<i class="fa fa-check bg-green" style="padding:4px 1em"></i>
                                    @elseif ($item->status == 2)
                                        آپلود فیش <i class="fa fa-check bg-orange" style="padding:4px 1em"></i>
                                    @elseif ($item->status == 1)
                                        ارسال به بانک
                                    @elseif ($item->status == -1)
                                        <span class="bg-red" style="padding: 0 1em">رد شد</span>
                                    @else
                                        ثبت شده
                                    @endif

                                </td>

                                <td class="">{{ convertGToJ($item->updated_at, $time = true) }}

                                </td>
                                <td class="">{{ convertGToJ($item->created_at, true) }} </td>

                                <td>

                                    <div style="display: flex; gap:1em; align-items: center; justify-content: space-around">

                                        <a class="btn btn-info btn-sm" href="{{ route('admin.order.detail', $item) }}">
                                            @lang('messages.detail') ({{ $item->orderDetail()->count() }})
                                        </a>
                                        <form class="" action="{{ route('admin.order.destroy', $item) }}"
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


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
