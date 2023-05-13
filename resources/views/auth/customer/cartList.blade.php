@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel max-w-lg mx-auto my-10">
        <link rel="stylesheet" href="{{ mix('panel/panel.css', env('TEMPLATE_NAME')) }}">
        @if (Auth::user())
            {{-- @include('auth.customer.nav') --}}
        @endif

        <div class="list    ">
            <h1 class="p-0 ">@lang('messages.cart') </h1>
            <div class="flex  one  ">
                @foreach ($cart as $content)
                    <div class="item border-b py-4  relative">
                        <div class=" ">

                            <div class="mr-0">
                                <a href="{{ url($content['associatedModel']['slug']) }}">
                                    @if (file_exists(public_path() . $content['associatedModel']['images']['images']['small']))
                                        <img class="rounded"
                                            src="{{ $content['associatedModel']['images']['images']['small'] }}"
                                            alt="">
                                    @else
                                        <img class="m-auto p-4" width=""
                                            src="https://img.icons8.com/ios/50/cccccc/no-image.png"
                                            alt="company-no-image" />
                                    @endif
                                </a>
                            </div>

                            {{-- <div>{{ convertGtoJ($content->created_at) }}</div> --}}
                            <div class="pr-5">
                                <div class=" text-sm">
                                    @if (isset($content['associatedModel']['attr']['in-stock']) && $content['associatedModel']['attr']['in-stock'] == 1)
                                        <span class="text-slate-400">قیمت:</span>
                                    @else
                                        <span class="text-slate-400">بیعانه:</span>
                                    @endif
                                    @convertCurrency($content['price']) @lang('messages.toman')
                                </div>
                                <div class="text-slate-600 text-sm">
                                    <span class="text-slate-400">وزن:</span>
                                    {{ $content['associatedModel']['attr']['weight'] }}g
                                </div>

                                <div>
                                    <form method="post" action="{{ route('customer.cart.destroy', $content['id']) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-700 text-sm absolute top-0 -left-4"><span class="">حذف
                                            </span> <i class="fa fa-remove"></i> </button>
                                    </form>
                                </div>
                                @if (isset($content['associatedModel']['attr']['in-stock']) && $content['associatedModel']['attr']['in-stock'] == 1)
                                    <p class="flex justify-start"><svg class="w-10 fill-lime-950"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true" class="nu rw uk axs">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd"></path>
                                        </svg><span>موجود</span></p>
                                @endif

                            </div>
                            <div class="inline bg-gray hidden ">
                                <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                    @csrf
                                    <input type="hidden" name="count" value="1">
                                    <button class="py-0"><i class="fa fa-plus"></i></button>
                                </form>
                                {{ $content['quantity'] }}
                                <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                    @csrf
                                    <input type="hidden" name="count" value="-1">
                                    <button class="py-0"><i class="fa fa-minus"></i></button>
                                </form>

                            </div>









                        </div>
                        @if (isset($content['associatedModel']['attr']['in-stock']) && $content['associatedModel']['attr']['in-stock'] == 0)
                            <div class=" bg-yellow-100 border rounded-sm mt-2">
                                <p class="text-sm p-1">وزن دقیق و قیمت نهایی بعد از ساخت که ۷ الی ۱۰ روز کاری زمان می برد
                                    مشخص می شود.
                                    این مبلغ به عنوان بیعانه دریافت می شود</p>
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="align-center">
                    @if (count($cart))

                        <form method="post" id="customer-order-store" action="{{ route('customer.order.store') }}">
                            @csrf
                            <button class="btn px-5 btn-buy">ادامه خرید ← </button>
                        </form>

                        @if (\Request::header('Referer') == url('login'))
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                            <script>
                                console.log('after login');
                                $(window).ready(function(e) {
                                    $('#customer-order-store').submit();
                                });
                            </script>
                        @endif
                    @else
                        @lang('messages.not found')
                    @endif
                </div>
            </div>

        </div>
    </section>

@endsection
