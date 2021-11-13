@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.Dashboard'))

@section('Content')

    <section class="panel">
        @include('auth.company.nav')

        <div>
            <h1>@lang('messages.Dashboard')</h1>
            <div class="flex one three-500">

                @isset($user->company->contents)

                <a href="{{ route('company.products') }}" class="widget shadow border-radius-10 p-1 m-1 one fifth-500 bg-purple flex">
                    <h2>محصولات</h2>
                    <span class="font-13 bold">{{ $user->company->contents->count() ?? 0 }}</span>
                </a>
                @endisset

                @isset($user->company->viewCount)
                <a  class="widget shadow border-radius-10 p-1 m-1 one fifth-500 bg-orange flex">
                    <h2>تعداد دفعات  نمایش داده شده</h2>
                    <span class="font-13 bold">{{ $user->company->viewCount ?? 0 }}</span>
                </a>
                @endisset
            </div>
        </div>
    </section>

@endsection
