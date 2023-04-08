@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">@lang('messages.orders') </h1>
            <div class="flex one">
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


                @foreach ($orders as $content)
                    <div class="item ">
                        <div class="info">
                            <div class="">
                                <a class="btn  btn-primary inline-block  pt-0 pb-0     "
                                    href="{{ route('customer.order.detail', $content->id) }}">
                                    <span>مشاهده جزییات سفارش</span>
                                </a>
                            </div>
                            <div class="font-08">{{ convertGtoJ($content->created_at) }}</div>
                            <div class="">
                                <span class="pl-3 ">{{ $content->orderDetail->count() }} آیتم</span>
                                <span class="bold">
                                    @convertCurrency($content['total_price']) @lang('messages.toman')
                                </span>

                            </div>

                            <div>
                                @if ($content->status == 1)
                                    <div>@lang('messages.status'): @lang('messages.send to bank')</div>
                                @elseif ($content->status == 2)
                                    <div class="yellow">
                                        @lang('messages.status'): فیش آپلود شده و در حال بررسی میباشد
                                        {{-- @foreach ($content->transactions as $item)
                                            <a class="btn btn-sm btn-info py-0" href="{{ $item->description }}">مشاهده
                                                فایل</a>
                                        @endforeach --}}
                                    </div>
                                @elseif ($content->status == 3)
                                    <div class="green">@lang('messages.status'): @lang('messages.paid successfully')</div>
                                @elseif ($content->status == 4)
                                    <div class="green">@lang('messages.status'): @lang('messages.prepairing')</div>
                                @elseif ($content->status == 5)
                                    <div class="green">@lang('messages.status'): @lang('messages.ready to send')</div>
                                @elseif ($content->status == -1)
                                    <div class="red">
                                        @lang('messages.status'): سفارش رد شد
                                        {{ $content->message }}
                                    </div>
                                @else
                                    <div class="red text-center bg-gray2 border-radius-5 my-1 p-1">
                                        {{-- @if (Auth::user()?->customer?->name == '' || Auth::user()?->customer?->address == '')
                                            <a href="{{ route('customer.profile') }}"
                                                class="widget shadow border-radius-10 p-1 mb-1  bg-gray-dark flex h-full">
                                                <h2 class="white">گام اول:
                                                    (
                                                    @if (Auth::user()?->customer?->name == '')
                                                        <span class=" "> نام</span>
                                                        {{ Auth::user()?->customer?->address == '' ? ',' : '' }}
                                                    @endif
                                                    @if (Auth::user()?->customer?->address == '')
                                                        <span class=" "> آدرس</span>
                                                    @endif
                                                    )
                                                    را تکمیل نمایید <i class="fa fa-external-link-alt"></i>
                                                </h2>

                                            </a>
                                        @endif --}}
                                        @lang('messages.status'):
                                        @lang('messages.pending')
                                        {{-- <form method="post" enctype="multipart/form-data" class=""
                                            action="{{ route('customer.uploadBill', ['order' => $content->id]) }}">
                                            @csrf
                                            @method('post')
                                            <input type="file" name="bill">
                                            <button class="btn  btn-info ">ثبت فیش</button>
                                        </form> --}}
                                        <span>
                                            @if ($content->status == 0)
                                                <form method="post"
                                                    action="{{ route('customer.order.destroy', $content['id']) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger py-0 mt-1" onclick="return confirm('آیا از حذف سفارش مطمئن هستید؟')"><span class="hidden-500">حذف
                                                            سفارش</span>
                                                        <i class="fa fa-remove"></i> </button>
                                                </form>
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>


                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <hr class="p-0">
                    @endif
                @endforeach
                <div class="align-center">
                    @if (count($orders) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
