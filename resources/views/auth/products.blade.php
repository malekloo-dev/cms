@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.Products')</h1>
            
        </div>
    </section>

@endsection
