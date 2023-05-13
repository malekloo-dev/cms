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
                    <div class="">
                        <a class="text-black" href="{{ route('customer.order.detail', $content->id) }}">
                            <div class="w-full relative ">
                                @if ($content->status == 1)
                                    <div>@lang('messages.status'): @lang('messages.send to bank')</div>
                                @elseif ($content->status == 2)
                                    <div>
                                        <span class="">فیش آپلود شده و در حال بررسی می
                                            باشد</span>
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
                                    <div class="green"><svg class="w-5 fill-lime-950" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="nu rw uk axs">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd"></path>
                                        </svg> @lang('messages.ready to send')</div>
                                @elseif ($content->status == -1)
                                    <div class="red">
                                        @lang('messages.status'): سفارش رد شد
                                        {{ $content->message }}
                                    </div>
                                @else
                                    <div>
                                        <i class="fa fa-remove bg-red-600 text-white w-5 h-5 p-1 text-sm  rounded-full text-center "></i>
                                        @lang('messages.pending')
                                    </div>
                                @endif


                                <span
                                    class=" inline-block  bg-gray-100 w-6 h-6 text-center rounded-full justify-center absolute left-0 top-1"
                                    href="{{ route('customer.order.detail', $content->id) }}">
                                    <span>></span>
                                </span>
                            </div>
                        </a>


                        <div class="flex justify-between">
                            <div class="font-08 text-slate-500">{{ convertGtoJ($content->created_at) }}</div>
                            <div class="bold left p-0">

                                @convertCurrency($content['total_price']) @lang('messages.toman')

                            </div>
                        </div>







                        <div>
                            @if ($content->status == 0)
                                <form method="post" action="{{ route('customer.order.destroy', $content['id']) }}">
                                    @csrf
                                    @method('delete')
                                    <button class=" text-red-600 text-xs px-0"
                                        onclick="return confirm('آیا از حذف سفارش مطمئن هستید؟')">
                                        <span class="hidden-500"><i class="fa fa-remove"></i> حذف سفارش</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="flex mt-3 mb-3 gap-1">
                            @foreach ($content->orderDetail as $item)
                                <img width="50" class="rounded" src="{{ $item->attributes['image'] }}">
                            @endforeach
                        </div>
                    </div>
                    @if (!$loop->last)
                        <hr class=" my-3">
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
