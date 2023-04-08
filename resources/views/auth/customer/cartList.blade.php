@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">@lang('messages.cart') </h1>
            <div class="flex one">
                @foreach ($cart as $content)
                    <div class="item ">
                        <div class="info">

                            <div>
                                <a href="{{ url($content['associatedModel']['slug']) }}">
                                    @if (file_exists(public_path() . $content['associatedModel']['images']['images']['small']))
                                        <img src="{{ $content['associatedModel']['images']['images']['small'] }}"
                                            alt="">
                                    @else
                                        <img class="m-auto p-4" width=""
                                            src="https://img.icons8.com/ios/50/cccccc/no-image.png"
                                            alt="company-no-image" />
                                    @endif
                                </a>
                            </div>

                            {{-- <div>{{ convertGtoJ($content->created_at) }}</div> --}}
                            <div>@convertCurrency($content['price']) @lang('messages.toman')</div>
                            <div class="inline bg-gray  ">
                                <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                    @csrf
                                    <input type="hidden" name="count" value="1">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                                </form>
                                {{ $content['quantity'] }}
                                <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                    @csrf
                                    <input type="hidden" name="count" value="-1">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-minus"></i></button>
                                </form>

                            </div>
                            <div>
                                <form method="post" action="{{ route('customer.cart.destroy', $content['id']) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"><span class="hidden-500">حذف آیتم</span> <i
                                            class="fa fa-remove"></i> </button>
                                </form>
                            </div>



                        </div>

                    </div>
                @endforeach
                <div class="align-center">
                    @if (count($cart))
                        <form method="post" action="{{ route('customer.order.store') }}">
                            @csrf
                            <button class="btn px-5 btn-buy">ادامه خرید ←  </button>
                        </form>
                    @else
                        @lang('messages.not found')
                    @endif
                </div>
            </div>

        </div>
    </section>

@endsection
