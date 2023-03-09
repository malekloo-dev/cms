@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">@lang('messages.orders') </h1>
            <div class="flex one">
                @foreach ($orders as $content)
                    <div class="item ">
                        <div class="info">

                            <div class="font-08">{{ convertGtoJ($content->created_at) }}</div>
                            <div class="bold">@convertCurrency($content['total_price']) @lang('messages.toman')</div>
                            <div class="fourth-700">
                                <div class="flex  two ">
                                    <div>
                                        <a class="btn btn-sm btn-primary inline-block font-07 pt-0 pb-0 pr-0    "
                                            href="{{ route('customer.order.detail', $content->id) }}">
                                            <span class="px-1">{{ $content->orderDetail->count() }}</span>@lang('messages.product')</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if ($content->status == 1)
                                    <div>@lang('messages.status'): @lang('messages.send to bank')</div>
                                @elseif ($content->status == 2)
                                    <div class="green">@lang('messages.status'): @lang('messages.paid successfully')</div>
                                @elseif ($content->status == 3)
                                    <div class="green">@lang('messages.status'): @lang('messages.prepairing')</div>
                                @elseif ($content->status == 4)
                                    <div class="green">@lang('messages.status'): @lang('messages.ready to delivery')</div>
                                @elseif ($content->status == -1)
                                    <div class="red">@lang('messages.status'): @lang('messages.unconfirm')</div>
                                @else
                                    <div class="red text-center bg-gray2 border-radius-5">@lang('messages.status'):
                                        @lang('messages.pending')
                                        <form class="" action="">
                                            <button class="btn btn-sm btn-info py-0">ثبت فیش</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if ($content->status == 0)
                                    <form method="post" action="{{ route('customer.order.destroy', $content['id']) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm py-0"><span class="hidden-500">حذف آیتم</span> <i
                                                class="fa fa-remove"></i> </button>
                                    </form>
                                @endif


                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <hr class="p-0">
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection
