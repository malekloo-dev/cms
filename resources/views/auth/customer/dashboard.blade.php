@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.Dashboard'))

@section('Content')

    <section class="panel">
        @include('auth.customer.nav')

        <div>
            <div class="flex one four-500">

                @hasrole(['company','super admin'])
                    @isset($user->customer)
                        @if ($user?->customer?->status == 0)
                            <div class="one thirdth-500 ">

                                <a href="{{ route('customer.profile') }}"
                                    class="widget shadow border-radius-10 p-1   bg-theme-color flex h-full">
                                    <h2>وضعیت کمپانی </h2>
                                    <div class="full">
                                        (
                                        @if ($user->customer->status == 0)
                                            <span class=" "> غیر فعال یا در حال بررسی می باشد</span>
                                        @endif
                                        @if ($user->customer->status == 1)
                                            <span class=" ">فعال </span>
                                        @endif
                                        )
                                    </div>

                                </a>
                            </div>
                        @endif
                    @endisset
                @endrole


                @isset($user->customer)
                    @if ($user?->customer?->name == '' || $user?->customer?->address == '')
                        <div class="one thirdth-500 mb-1">

                            <a href="{{ route('customer.profile') }}"
                                class=" border rounded-lg py-2 px-5   bg-gray-700 text-white flex flex-col ">
                                <div class="text-white w-full"> موارد زیر را تکمیل نمایید <i class="fa fa-external-link-alt"></i></div>
                                <div class="w-full text-white">
                                    (
                                    @if ($user->customer->name == '')
                                        <span class=" "> نام</span>
                                        {{ $user->customer->address == '' ? ',' : '' }}
                                    @endif
                                    @if ($user->customer->address == '')
                                        <span class=" "> آدرس</span>
                                    @endif

                                    )
                                </div>

                            </a>
                        </div>
                    @endif
                @endisset

                @isset($user->customer->contents)
                    <div class="one fourth-500 ">
                        <div class="widget shadow border-radius-10 p-1   bg-purple h-full">
                            <h2> شما <span class="font-13 bold">{{ $user->customer->contents->count() ?? 0 }}</span> محصول
                                دارید </h2>
                            <a href="{{ route('customer.products') }}" class="">
                                <span class="">دیدن لیست محصولات <i class="fa fa-external-link-alt"></i></span>

                            </a>

                        </div>
                    </div>
                @endisset

                @isset($user->customer->viewCount)
                    <div class="one fourth-500">
                        <div class="widget shadow border-radius-10 p-1   bg-orange block h-full">
                            <h2><span class="font-13 bold">{{ $user->customer->viewCount ?? 0 }}</span> بار کمپانی شما دیده
                                شده است </h2>

                            <a href="{{ route('customer.profile') }}">دیدن پروفابل <i class="fa fa-external-link-alt"></i></a>
                        </div>
                    </div>
                @endisset
            </div>

            @hasrole('customer')
                <div class="border  rounded-md p-1">
                    <h2>سفارشات من</h2>
                    <div>
                        جاری
                    </div>

                </div>
            @endrole
        </div>





    </section>

@endsection
