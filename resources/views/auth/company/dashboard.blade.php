@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.Dashboard'))

@section('Content')

    <section class="panel">
        @include('auth.company.nav')

        <div>
            <h1>@lang('messages.Dashboard')</h1>
            <div class="flex one four-500">

                @isset($user->company)
                    @if ($user?->company?->name == '' || $user?->company?->logo == '')
                        <div class="one thirdth-500 ">

                            <a href="{{ route('company.profile') }}"
                                class="widget shadow border-radius-10 p-1   bg-gray-dark flex h-full">
                                <h2>گام اول: موارد زیر را تکمیل نمایید <i class="fa fa-external-link-alt"></i></h2>
                                <div class="full">
                                    @if ($user->company->name == '')
                                        <span class=" ">  نام شرکت یا مغازه </span>
                                    @endif
                                    @if ($user->company->logo == '')
                                        <span class=" ">تصویر </span>
                                    @endif
                                </div>

                            </a>
                        </div>
                    @endif
                @endisset

                @isset($user->company->contents)
                    <div class="one fourth-500 ">
                        <div class="widget shadow border-radius-10 p-1   bg-purple h-full" >
                            <h2> شما <span class="font-13 bold">{{ $user->company->contents->count() ?? 0 }}</span> محصول دارید </h2>
                            <a href="{{ route('company.products') }}" class="">
                                    <span class="font-08 bold">(دیدن لیست محصولات)</span>

                            </a>

                        </div>
                    </div>
                @endisset

                @isset($user->company->viewCount)
                    <div class="one fourth-500">
                        <div class="widget shadow border-radius-10 p-1   bg-orange block h-full">
                            <h2><span class="font-13 bold">{{ $user->company->viewCount ?? 0 }}</span> بار کمپانی شما دیده شده است </h2>

                            <a href="">دیدن پروفابل <i class="fa fa-external-link-alt"></i></a>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>

@endsection
