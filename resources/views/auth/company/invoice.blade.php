@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.invoice'))

@section('Content')
<section class="panel">
    @include('auth.company.nav')


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

        <form action="{{ route('company.sendToBand', $transaction->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <table class="table">
                <tr>
                    <td>@lang('messages.row')</td>
                    <td>{{ __('messages.product code') }}</td>
                    <td>{{ __('messages.product') }}</td>
                    <td>@lang('messages.count')</td>
                    <td>@lang('messages.expire data')</td>
                    <td>@lang('messages.price one')</td>
                    <td>@lang('messages.total price')</td>
                    <td>@lang('messages.describe')</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>{{ $parentModel->id }}</td>
                    <td>{{ $parentModel->title }}</td>
                    <td>{{ $transaction->count }}</td>
                    <td>@lang('messages.duration',['month'=>3])</td>
                    <td>@convertCurrency(30000) @lang('messages.toman')</td>
                    <td class="bold">@convertCurrency($transaction->price) @lang('messages.toman')</td>
                    <td>{{ $transaction->description }}</td>
                </tr>
            </table>

            <table align="left" class="">
                <tr class="">
                    <td class="text-left">@lang('messages.sum'): @convertCurrency($transaction->price) @lang('messages.toman')</td>
                </tr>
                <tr>
                    <td class="text-left">@lang('messages.tax'): -</td>
                </tr>
                <tr>
                    <td class="text-left">@lang('messages.discount'): -</td>
                </tr>
                <tr>
                    <td class="text-left total-price">@lang('messages.pay price'): @convertCurrency($transaction->price) @lang('messages.toman')</td>
                </tr>
            </table>
            @if($transaction->status != 2)
                <span id="PPTrust"></span>
                <script src="https://cdn.payping.ir/statics/trust-v2.js" theme="dark" size="lg"></script>
            @endif
            <div class="flex center">
                @if($transaction->status != 2)
                    <button type="submit" class="btn btn-success ">@lang('messages.pay')</button>
                @else
                    @lang('messages.pay success')
                @endif

            </div>
        </form>
    </div>
</section>



@endsection
