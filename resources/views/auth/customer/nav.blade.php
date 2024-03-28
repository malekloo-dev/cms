<link rel="stylesheet" href="{{ mix('panel/panel.css', env('TEMPLATE_NAME')) }}">


<div class="company-nav" style="position: relative">
    <div class="company-menu" style="position: absolute; right:60px; top:10px; font-weight: bold ">منوی پروفایل</div>
    <div class="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul>
        <li class="company-logo">
            {{-- @if (!isset(Auth::user()->customer->logo['large']) || Auth::user()->customer->logo['large'] == '' || !file_exists(public_path(Auth::user()->customer->logo['large'])))
                <i class="far fa-user logo"></i>
            @else
                <img width="100" src="{{ url(Auth::user()->customer->logo['large']) }}?{{ uniqid() }}">
            @endif --}}


        </li>
        <li>
            {{ Auth::user()->mobile ?? ''}}
        </li>
        {{-- <li class="price">
            <i class="fa fa-wallet"></i>
            @convertCurrency(0) {{ __('messages.toman') }}
        </li> --}}


        {{-- <li class="{{ Request::is('customer') ? 'active' : '' }}"><a
                href="{{ route('customer.dashboard') }}">{{ __('messages.Dashboard') }}</a></li> --}}

        @hasrole('company')
            <li class="{{ Request::is('customer/profile') ? 'active' : '' }}"><a href="{{ route('customer.profile') }}">
                    {{ __('messages.profile') }}</a></li>
        @endrole

        <li class="{{ Request::is('customer/cart') ? 'active' : '' }}"><a class="no-border"
                href="{{ route('customer.cart.list') }}"> {{ __('messages.cart') }}</a></li>

        <li class="{{ Request::is('customer/orders') ? 'active' : '' }}"><a href="{{ route('customer.order.list') }}">
                {{ __('messages.orders') }}</a></li>

        <li class="{{ Request::is('customer/transaction') ? 'active' : '' }}"><a class="no-border"
                href="{{ route('customer.transaction') }}"> {{ __('messages.transaction') }}</a></li>




{{--
        <li class="{{ Request::is('customer/invoice') ? 'active' : '' }}"><a class="no-border"
                href="{{ route('customer.invoice.list') }}"> {{ __('messages.invoices') }}</a></li> --}}


        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-danger">@lang('messages.logout')</button>
            </form>
        </li>
    </ul>
</div>

<style>
    .price {
        color: #333;
        font-size: 1.3em;
        font-weight: normal
    }

    @media (min-width:960px) {
        .company-menu {
            display: none
        }
    }
</style>


<script src="{{asset('/jquery-3.6.0.min.js')}}"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>
    $('.burger').click(function() {
        $('.company-nav ul').slideToggle();
        $(this).children('span:last-child').toggleClass('hide');
        $(this).children('span:nth-child(1)').toggleClass('rotate1');
        $(this).children('span:nth-child(2)').toggleClass('rotate2');
    })
</script>


@section('bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-4dNpRvNX0c/TdYEbYup8qbjvjaMrgUPh+g4I03CnNtANuv+VAvPL6LqdwzZKV38G" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
@endsection
