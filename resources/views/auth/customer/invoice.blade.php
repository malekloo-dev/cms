@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.invoice'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')


        <div class="invoice">
            <h1>{{ __('messages.invoice') }}</h1>

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

            <div class="billing-info">
                <div>
                    @lang('messages.billing name'): {{ $transaction->user->name ?? '-' }}<br>
                    @lang('messages.mobile'): {{ $transaction->user->mobile ?? '-' }}
                </div>
                <div class="">
                    @lang('messages.date'): {{ convertGtoJ($transaction->created_at) }}<br>
                    @lang('messages.invoice number'): {{ $transaction->id }}
                </div>
            </div>

            <form action="{{ route('company.sendToBand', $transaction->id) }}" method="POST" style="">
                @method('PATCH')
                @csrf




                <div class="invoice-items" style="">

                    {{-- <div>{{ __('messages.product') }}</div>
                    <div>{{ $parentModel->title }}</div>

                    <div>@lang('messages.power')</div>
                    <div>{{ $transaction->count }}</div>

                    <div>@lang('messages.expire data')</div>
                    <div>@lang('messages.duration',['month'=>3])</div>

                    <div>@lang('messages.price one')</div>
                    <div>@convertCurrency(30000) @lang('messages.toman')</div>

                    <div>@lang('messages.total price')</div>
                    <div class="bold">@convertCurrency($transaction->price) @lang('messages.toman')</div> --}}



                    <table class="table" style="">
                        <tr>
                            <td>{{ __('messages.product') }}</td>
                            <td>{{ $parentModel->title }}</td>
                        </tr>
                        <tr>
                            <td>@lang('messages.power')</td>
                            <td>{{ $transaction->count }}</td>
                        </tr>
                        <tr>
                            <td>@lang('messages.expire data')</td>
                            <td>@lang('messages.duration',['month'=>3])</td>
                        </tr>
                        <tr>
                            <td>@lang('messages.price one')</td>
                            <td>@convertCurrency(30000) @lang('messages.toman')</td>
                        </tr>
                        <tr>
                            <td>@lang('messages.total price')</td>
                            <td class="bold">@convertCurrency($transaction->price) @lang('messages.toman')</td>
                        </tr>


                    </table>
                </div>
                <table align="left" class="mb-1">
                    <tr class="">
                        <td class="text-left">@lang('messages.sum'): @convertCurrency($transaction->price)
                            @lang('messages.toman')</td>
                    </tr>
                    <tr>
                        <td class="text-left">@lang('messages.tax'): -</td>
                    </tr>
                    <tr>
                        <td class="text-left">@lang('messages.discount'): -</td>
                    </tr>
                    <tr>
                        <td class="text-left total-price">مبلغ قابل پرداخت: @convertCurrency($transaction->price)
                            @lang('messages.toman')</td>
                    </tr>
                </table>
                @if ($transaction->status != 2)
                    <span id="PPTrust"></span>
                    <script src="https://cdn.payping.ir/statics/trust-v2.js" theme="light" size="sm"></script>
                @endif
                <div class="flex center">
                    @if ($transaction->status != 2)
                        <button type="submit" class="btn btn-success ">@lang('messages.pay')</button>
                    @else
                        @lang('messages.pay success')
                    @endif

                </div>
            </form>
        </div>
    </section>



@endsection
