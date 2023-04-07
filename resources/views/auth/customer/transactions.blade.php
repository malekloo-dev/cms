@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', 'پرداختی ها')

@section('Content')
    {{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">@lang('messages.transaction') </h1>

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
            @endif

            @if (\Session::has('error'))
                <div class="alert alert-danger">

                    {!! \Session::get('error') !!}
                </div>
            @endif
            @isset($transactions)


                @foreach ($transactions as $content)
                    <div class="flex one five-500">
                        <div>
                            @lang('messages.title'): {{ $content->title }}
                        </div>
                        <div>
                            @lang('messages.date'): {{ convertGtoJ($content->created_at) }}
                        </div>
                        <div>
                            @lang('messages.price'): @convertCurrency($content->price) @lang('messages.toman')
                        </div>
                        <div>
                            @if ($content->status == 2)
                                <div class="green">@lang('messages.ok')</div>
                            @elseif ($content->status == 3)
                                <div class="green">فیش آپلود شده و در حال بررسی</div>
                            @else
                                <div class="red">
                                    @lang('messages.not ok')
                                </div>
                            @endif
                        </div>
                        <div>
                            @lang('messages.message'): {{ $content->message }}
                        </div>
                    </div>
                @endforeach
                {{ $transactions->links() }}

                <div class="align-center">
                    @if (count($transactions) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            @endisset


        </div>
    </section>

@endsection
