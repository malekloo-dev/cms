@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="flex">
                <a class="font-08"
                    href="{{ route('customer.order.list') }}">{{ Lang::get('messages.back to', ['page' => Lang::get('messages.order')]) }}</a>
                <span class="align-left font-08"></span>
            </h1>
            <div class="flex">

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger">

                        {!! \Session::get('error') !!}
                    </div>
                @endif

                <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">


                    <div class="">


                        @foreach ($orderDetail as $content)
                            @php
                                $pid = $content['attributes']['product_id'];
                                $pr = \App\Models\Content::find($pid);
                            @endphp
                            <div class="item border-b py-4  relative">
                                <div class=" ">

                                    <div class="mr-0">
                                        <a target="__blank" href="{{ url($pr->slug) }}">
                                            @if (file_exists(public_path() . $content['attributes']['image']))
                                                <img class="rounded" src="{{ $content['attributes']['image'] }}"
                                                    alt="">
                                            @else
                                                <img class="m-auto p-4" width=""
                                                    src="https://img.icons8.com/ios/50/cccccc/no-image.png"
                                                    alt="company-no-image" />
                                            @endif
                                        </a>
                                    </div>

                                    <div class="pr-5">
                                        <div class=" text-sm">
                                            @if (isset($pr['attr']['in-stock']) && $pr['attr']['in-stock'] == 1)
                                                <span class="text-slate-400">قیمت:</span>
                                            @else
                                                <span class="text-slate-400">بیعانه:</span>
                                            @endif
                                            @convertCurrency($content['price']) @lang('messages.toman')
                                        </div>
                                        <div class="text-slate-600 text-sm">
                                            <span class="text-slate-400">وزن:</span>
                                            {{ $pr['attr']['weight'] }}g
                                        </div>


                                        @if (isset($pr['attr']['in-stock']) && $pr['attr']['in-stock'] == 1)
                                            <p class="flex justify-start"><svg class="w-10 fill-lime-950"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true" class="nu rw uk axs">
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

                                @if (isset($pr['attr']['in-stock']) && $pr['attr']['in-stock'] == 0)
                                    <div class=" bg-yellow-100 border rounded-sm mt-2">
                                        <p class="text-sm p-1">وزن دقیق و قیمت نهایی بعد از ساخت که ۷ الی ۱۰ روز کاری زمان
                                            می
                                            برد
                                            مشخص می شود.
                                            این مبلغ به عنوان بیعانه دریافت می شود</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>



                    <div class=" pb-3 px-1 bg-slate-100  border rounded">
                        <meta name="_token" content="{{ csrf_token() }}">
                        <h2> آدرس و مشخصات تحویل گیرنده</h2>
                        <div class=" ">موبایل:
                            <span class="    inline-block m-1 rounded " data-field="mobile"
                                data-label="@lang('messages.mobile')">{{ Auth::user()->customer->mobile ?? '' }}</span>
                        </div>
                        <div class="">
                            @lang('messages.name'):
                            <span class="text-editor text-blue-500  px-3 inline-block m-1 rounded cursor-pointer"
                                data-field="name"
                                data-label="@lang('messages.name')">{{ Auth::user()->customer->name ?? '' }}</span>
                        </div>
                        <div class="relative">
                            @lang('messages.address'):
                            @if (!isset(Auth::user()->customer->address) || Auth::user()->customer->address == '')
                                <span class="absolute right-0 top-6 text-red-700  p-1 -mr-3 px-3 text-xs">آدرس را وارد
                                    نمایید</span>
                            @endif
                            <span class="text-editor text-blue-500  px-3 inline-block m-1 mb-4   rounded cursor-pointer"
                                data-field="address"
                                data-label="@lang('messages.address')">{{ Auth::user()->customer->address ?? '' }}</span>
                        </div>

                        <div class="relative">@lang('messages.zipcode'):
                            @if (!isset(Auth::user()->customer->zipcode) || Auth::user()->customer->zipcode == '')
                                <span class="absolute right-0 top-6 text-red-700  p-1 -mr-3 px-3 text-xs">کد پستی را وارد
                                    نمایید</span>
                            @endif
                            <span class=" text-editor text-blue-500  px-3 inline-block m-1   rounded cursor-pointer"
                                data-field="zipcode"
                                data-label="@lang('messages.zipcode')">{{ Auth::user()->customer->zipcode ?? '' }}</span>
                        </div>



                    </div>


                    <div class="   p-1 bg-slate-100 border rounded">
                        <h2>روش پرداخت</h2>

                        <h3 class="">آپلود فیش</h3>
                        <p class="border bg-yellow-50 rounded-md p-1 text-xs">بعد از پرداخت کارت به کارت تصویر فیش خود را آپلود نماید تا تیم فروش مراحل خرید شما را پیگیری نمایند.</p>
                        <p class="border bg-green-50 rounded-md p-1 mt-1 text-xs">شماره کارت به نام حمیده اخضری
                            <br>
                            <span class="font-bold ltr">6104-3379-7236-7427</span>
                        </p>
                        @if ($content->order->status == 0)

                            <form method="post" enctype="multipart/form-data" class="flex mt-6   px-1 py-1 align-"
                                action="{{ route('customer.uploadBill', ['order' => $content->order->id]) }}">
                                @csrf
                                @method('post')

                                <input type="file" name="bill"
                                    class="block text-sm text-gray-500
                        border-0 w-2/3
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full
                        file:text-sm file:font-semibold
                        file:bg-gray-50 file:text-gray-500 cursor-pointer
                        hover:file:bg-gray-100 file:border file:border-solid file:border-gray-500
                      ">

                                <button class="rounded-full border bg-blue-500 text-white p-1 px-3 font-normal">ثبت فیش</button>
                            </form>
                        @else
                            @foreach ($content->order->transactions as $item)
                                <a  target="__blunk" class="rounded-full border bg-blue-500 text-white p-1 px-3 mt-1 inline-block font-normal" href="{{ $item->description }}">مشاهده فیش</a>
                            @endforeach
                        @endif
                    </div>

                </div>


            </div>

        </div>
    </section>

@endsection

@section('footer')
    <script>
        $.each($(' .text-editor'), function(i, n) {
            $(this).append(
                '<i class="fa-edit far fa-edit  text-lg cursor-pointer"></i>'
            )
        });

        $(' .text-editor').click(function() {

            $('.profile-editor-modal input[type=text]').attr('name', '');
            $('.profile-editor-modal label').html('');
            var field = $(this).data('field');
            var label = $(this).data('label');
            var val = $(this).text();
            $('#edit-profile').modal('show');
            $('.profile-editor-modal input[type=text]').attr('name', field);
            if (['email', 'mobile', 'site', 'whatsapp', 'telegram', 'instagram'].includes(field)) {
                $('.profile-editor-modal input[type=text]').css('direction', 'ltr');
            } else {
                $('.profile-editor-modal input[type=text]').css('direction', 'rtl');
            }
            $('.profile-editor-modal input[type=text]').val(val);
            $('.profile-editor-modal label').html(label);

        });

        $(function() {

            $('#edit-profile form').submit(function(e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('customer.profile.update') }}",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'data': $('#edit-profile form').serializeArray()
                    },
                    success: function(data) {
                        $('#edit-profile').modal('hide');
                        $('span[data-field=' + data.data.name + ']').text(data.data.value);
                        $('span[data-field=' + data.data.name + ']').append(
                            '<i class="fa-edit far fa-edit  text-lg cursor-pointer"></i>'
                        )
                    }
                });
            });

            $('#edit-profile .close').on('click', function() {
                $('#edit-profile').modal('hide');
            })
        });
    </script>
    <div class="modal fade profile-editor-modal" id="edit-profile" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog   top-1/3 m-auto " role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <form>
                                <div class="col-xs-12 py-1 ">
                                    <div class="col-md-12 col-xs-12 flex ">
                                        <label for="" class="px-1"></label>
                                        <input type="text" name="" class="flex-grow rounded px-1 focus:border-gray-950">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{-- <input type="submit" class="btn btn-info" value="@lang('messages.edit')"> --}}
                                    <button class="rounded-full border bg-blue-500 text-white p-1 px-3 font-normal">تایید
                                        <label for=""></label></button>
                                    <a class="close" href="#">@lang('messages.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
