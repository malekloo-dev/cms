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

                @foreach ($orderDetail as $content)
                    <div class="item ">
                        <div class="info">
                            <div>

                                <a href="{{ url($content['attributes']['slug'] ?? '') }}">

                                    @if (isset($content['attributes']['image']) && file_exists(public_path() . $content['attributes']['image']))
                                        <img src="{{ $content['attributes']['image'] }}" alt="">
                                    @else
                                        <img class="m-auto p-4" width=""
                                            src="https://img.icons8.com/ios/50/cccccc/no-image.png"
                                            alt="company-no-image" />
                                    @endif
                                </a>
                            </div>
                            @if ($content->order->status < 3)
                            <div>{{ $content['title'] }}</div>
                            @endif

                            <div>@convertCurrency($content['price']) @lang('messages.toman')</div>
                            <div>{{ $content['count'] }} @lang('messages.quantity')</div>
                        </div>

                    </div>
                    @if (!$loop->last)
                        <hr class="p-0">
                    @endif
                @endforeach

                {{-- @if (Auth::user()?->customer?->name == '' || Auth::user()?->customer?->address == '')
                    <a href="{{ route('customer.profile') }}" class="widget shadow border-radius-10 p-1 mb-1  bg-gray-dark flex h-full">
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


                <hr>
                <div class="flex">
                    <meta name="_token" content="{{ csrf_token() }}">
                    <span>
                        @lang('messages.name'):
                        <span class="text-editor" data-field="name"
                            data-label="@lang('messages.name')">{{ Auth::user()->customer->name ?? '' }}</span>
                    </span>
                    <span>
                        @lang('messages.address'): <span class="text-editor" data-field="address"
                            data-label="@lang('messages.address')">{{ Auth::user()->customer->address ?? '' }}</span>
                    </span>
                </div>
                @if ($content->order->status == 0)




                    <form method="post" enctype="multipart/form-data" class=""
                        action="{{ route('customer.uploadBill', ['order' => $content->order->id]) }}">
                        @csrf
                        @method('post')
                        <input type="file" name="bill">
                        <button class="btn  btn-info ">ثبت فیش</button>
                    </form>
                @else
                    @foreach ($content->order->transactions as $item)
                        <a class="btn btn-sm btn-info py-0" href="{{ $item->description }}">مشاهده فیش</a>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

@endsection

@section('footer')
    <script>
        $.each($(' .text-editor'), function(i, n) {
            $(this).append(
                '<i class="fa-edit far fa-edit color-inherit"></i>'
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
                            '<i class="fa-edit far fa-edit color-inherit"></i>'
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <h3>@lang('messages.edit')</h3>
                            <form>
                                <div class="col-xs-12 py-1 ">
                                    <div class="col-md-12 col-xs-12">
                                        <label for=""></label>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <input type="text" name="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{-- <input type="submit" class="btn btn-info" value="@lang('messages.edit')"> --}}
                                    <button class="btn btn-success">@lang('messages.edit')</button>
                                    <a class="btn red close" href="#">@lang('messages.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
