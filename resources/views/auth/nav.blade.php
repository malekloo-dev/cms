<div class="company-nav">
    <ul>
        <li>
            <svg  id="bold" enable-background="new 0 0 24 24" height="100" viewBox="0 0 24 24" width="100"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m19 19.5v-5c0-1.654 1.346-3 3-3 .552 0 1 .448 1 1 0 .556-.454 1.007-1.012 1-.548-.007-.988.452-.988 1v3c0 1.105-.895 2-2 2z" />
                <path
                    d="m5 19.5v-5c0-1.654-1.346-3-3-3-.552 0-1 .448-1 1 0 .556.454 1.007 1.012 1 .548-.007.988.452.988 1v3c0 1.105.895 2 2 2z" />
                <path d="m16.25 24h-8.5c-.552 0-1-.448-1-1s.448-1 1-1h8.5c.552 0 1 .448 1 1s-.448 1-1 1z" />
                <path d="m12 24c-.552 0-1-.448-1-1v-4.25c0-.552.448-1 1-1s1 .448 1 1v4.25c0 .552-.448 1-1 1z" />
                <path
                    d="m17.061 13h-10.122c-.518 0-1.006-.228-1.339-.624-.334-.396-.474-.916-.385-1.426l1.652-9.5c.146-.84.871-1.45 1.724-1.45h6.817c.854 0 1.579.61 1.724 1.451l1.652 9.5c.089.51-.051 1.03-.385 1.426-.332.395-.82.623-1.338.623z" />
                <path
                    d="m19.25 19.5h-14.5c-.414 0-.75-.336-.75-.75v-2c0-1.517 1.233-2.75 2.75-2.75h10.5c1.517 0 2.75 1.233 2.75 2.75v2c0 .414-.336.75-.75.75z" />
            </svg>

        </li>
        <li>
            {{ Auth::user()->name }}
        </li>
        <li class="{{ Request::is('company')?'active':'' }}"><a href="{{ route('company.dashboard') }}">{{ __('messages.Dashboard') }}</a></li>
        <li class="{{ Request::is('company/profile')?'active':'' }}"><a href="{{ route('company.profile') }}"> {{ __('messages.profile') }}</a></li>
        <li class="{{ Request::is('company/products')?'active':'' }}"><a class="no-border" href=""> {{ __('messages.Products') }}</a></li>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-link">@lang('messages.logout')</button>
            </form>
        </li>
    </ul>
</div>
