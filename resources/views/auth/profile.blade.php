@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.profile')</h1>
            <div>@lang('messages.store name'): {{ $user->company->name }}</div>
            <div>@lang('messages.mobile'): {{ $user->company->mobile }}</div>
            <div>@lang('messages.site'): {{ $user->company->site }}</div>
            <div>@lang('messages.email'): {{ $user->company->email }}</div>
            <div>@lang('messages.name'): {{ $user->name }}</div>
            <div>@lang('messages.register date'): {{ convertGToJ($user->date) }}</div>
        </div>
    </section>

@endsection
