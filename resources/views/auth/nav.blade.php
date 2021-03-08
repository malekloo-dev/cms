<div class="company-nav">
    <ul>
        <li><a href="{{ route('company.dashboard') }}">{{ __('messages.Dashboard') }}</a></li>
        <li><a href="{{ route('company.profile') }}">{{ Auth::user()->name }} {{ __('messages.profile') }}</a></li>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-link">@lang('messages.logout')</button>
            </form>
        </li>
    </ul>
</div>
<style>
    .company-nav ul {
        display: flex;
        list-style: none;
    }

    .company-nav ul li a {
        padding: 1em;
        display: block
    }

</style>
