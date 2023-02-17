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

                            <div>{{ convertGtoJ($content->created_at) }}</div>
                            <div>@convertCurrency($content['total_price']) @lang('messages.toman')</div>
                            <div class="">
                                <a class="btn btn-sm btn-primary" href="{{ route('customer.order.detail', $content->id) }}">
                                    <span>{{ $content->orderDetail->count() }}</span> @lang('messages.product')</a>
                            </div>
                            <div>
                                @if ($content->status == 2)
                                    <div class="green">@lang('messages.confirm')</div>
                                @elseif ($content->status == -1)
                                    <div class="red">@lang('messages.confirm')</div>
                                @else
                                    <div class="red text-center bg-theme-color">@lang('messages.order insert')</div>
                                @endif
                            </div>
                            <div>
                                @if ($content->status == 0)
                                    <form method="post" action="{{ route('customer.order.destroy', $content['id']) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><span class="hidden-500">حذف آیتم</span> <i
                                                class="fa fa-remove"></i> </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
