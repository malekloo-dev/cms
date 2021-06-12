@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.Dashboard')</h1>
            @isset($user->company->contents)
                <a href="{{ route('company.products') }}" class="widget shadow border-radius-10 p-1 one fifth-500 bg-purple">
                    <h2>محصولات</h2>
                    <span class="font-13 bold">{{ $user->company->contents->count() ?? 0 }}</span>
                </a>
            @endisset
        </div>
    </section>

@endsection
