@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.profile')</h1>
            <div>@lang('messages.name'): {{ $user->name }}</div>
            <div>@lang('messages.register date'): {{ convertGToJ($user->date) }}</div>
            

        </div>
    </section>
    <style>

        section.panel {
            background-color: #fff;
            padding: 1em;
            max-width: 1140px;
            margin: 5em auto
        }

    </style>

@endsection
