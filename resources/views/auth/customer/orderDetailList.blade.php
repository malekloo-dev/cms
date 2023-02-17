@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="flex">
                <a class="font-08" href="{{ route('customer.order.list') }}">{{ Lang::get('messages.back to', ['page' => Lang::get('messages.order')]) }}</a>
                <span class="align-left font-08">@lang('messages.date') {{ convertGtoJ($order->created_at) }}</span>
            </h1>
            <div class="flex one">
                @foreach ($orderDetail as $content)
                    <div class="item ">
                        <div class="info">
                            <div>
                                
                                <a href="{{ url($content['attributes']['slug'] ?? '') }}">

                                    @if (isset($content['attributes']['image']) && file_exists(public_path() . $content['attributes']['image']))
                                        <img src="{{ $content['attributes']['image'] }}"
                                            alt="">
                                    @else
                                        <img class="m-auto p-4" width=""
                                            src="https://img.icons8.com/ios/50/cccccc/no-image.png"
                                            alt="company-no-image" />
                                    @endif
                                </a>
                            </div>
                            <div>{{ $content['title'] }}</div>
                            <div>@convertCurrency($content['price']) @lang('messages.toman')</div>
                            <div>{{ $content['count'] }} @lang('messages.quantity')</div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </section>

@endsection
