@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', 'پرداختی ها')

@section('Content')
{{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


<section class="panel">
    @include('auth.customer.nav')

    <div class="list">
        <h1 class="">@lang('messages.transaction') </h1>

        @isset($transactions)


            @foreach ($transactions as $content)

                <div class="flex one five-500">
                    <div>
                        @lang('messages.date'): {{ convertGtoJ($content->created_at) }}
                    </div>
                    <div>
                        @lang('messages.price'): @convertCurrency($content->price) @lang('messages.toman')
                    </div>
                    <div>
                        @if ($content->status == 2)
                            <div class="green">@lang('messages.ok')</div>
                        @else
                            <div class="red">@lang('messages.not ok')</div>
                        @endif
                    </div>
                    <div>
                        @lang('messages.message'): {{ $content->message }}
                    </div>
                </div>
            @endforeach
            {{ $transactions->links() }}
        @endisset


    </div>
</section>

@endsection
