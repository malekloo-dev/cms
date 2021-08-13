@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.power up'))

@section('Content')
<section class="panel">
    @include('auth.company.nav')


    <div>
        <h1>{{ __('messages.upgrade power') }}</h1>

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

        <form action="{{ route('company.products.sendToBand', $content->id) }}" method="POST">

            @csrf
            <div class="row ">
                <div class="col-3 col-md-3 col-xs-12">
                    {{ __('messages.product') }}: {{ $content->title }}
                </div>

                <div class="col-3 col-md-3 col-xs-12">
                    {{ __('messages.power price') }}: @convertCurrency(30000) {{ __('messages.toman') }}
                </div>
                <div class="col-3 col-md-3 col-xs-12">
                    {{ __('messages.date') }}: {{ convertGtoJ(Carbon\Carbon::now()) }}
                </div>

                <script>
                    minus = (el) => {
                        el.parentNode.querySelector('input[type=number]').stepDown();
                        updateTotal();
                    }

                    plus = (el) => {
                        el.parentNode.querySelector('input[type=number]').stepUp();
                        updateTotal();
                    }

                    function updateTotal(num){

                        var total = 30000 * parseInt(document.getElementById('count').value);
                        total = new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(total);
                        document.getElementById('total-price').innerHTML = total + ` @lang('messages.toman')`;
                        return true;
                    }
                </script>

                <div class="col-2 col-md-2 col-xs-12">
                    <label for="name" class=""><i class="fa fa-bolt"></i> @lang('messages.power')</label>
                    <div class="number-input">
                        <span onclick="minus(this)"></span>
                        <input id="count" type="number" class="form-control" name="count" min="1"
                            value="{{ old('count', 1) }}" />
                        <span onclick="plus(this)" class="plus"></span>
                    </div>
                    <div id="total-price" >@convertCurrency(30000) @lang('messages.toman')</div>
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>

                <button type="submit" class="btn btn-success ">@lang('messages.confirm')</button>
            </div>
        </form>
    </div>
</section>


<style>
    input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .number-input {
        border: 2px solid #ddd;
        display: inline-flex;
    }

    .number-input,
    .number-input * {
        box-sizing: border-box;
    }

    .number-input span {
        outline: none;
        -webkit-appearance: none;
        background-color: transparent;
        border: none;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        cursor: pointer;
        margin: 0;
        position: relative;
        display: flex;
    }

    .number-input span:before,
    .number-input span:after {
        display: inline-block;
        position: absolute;
        content: '';
        width: 1rem;
        height: 3px;
        background-color: #212121;

        /* transform: translate(-50%, -50%); */
    }

    .number-input span.plus:after {
        transform: rotate(90deg);
    }

    .number-input input[type=number] {
        font-family: sans-serif;
        max-width: 5rem;
        padding: .5rem;
        border: solid #ddd;
        border-width: 0 2px;
        font-size: 2em;
        height: 3rem;
        font-weight: bold;
        text-align: center;
    }
    #total-price{color: #0b570b; font-weight: bold; font-size: 1.2em}

</style>
@endsection
