@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.product'))


@push('scripts')

    <!-- Scripts -->

    <script src="{{ url('/adminAssets/js/select2.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/persian-date.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/persian-datepicker.min.js') }}"></script>
    <link href="{{ url('/adminAssets/css/dependencies.css') }}" rel="stylesheet">

    <link href="{{ url('/adminAssets/css/persian-datepicker.min.css') }}" rel="stylesheet">



    <script>
        $(document).ready(function() {
            $('.datepicker').persianDatepicker({
                initialValue: true,
                format: 'YYYY/MM/DD',
                autoClose: true,
                responsive: false,
                "toolbox": {
                    "enabled": true,
                    "calendarSwitch": {
                        "enabled": false,
                        "format": "MMMM"
                    }
                }
            });


            var $input = $("#parent_id");
            var $parent_id_hide = $("#parent_id_hide");
            var $parent = $('#parent_id_hide').find(':selected').val();

            $parent_id_hide.select2();
            $input.select2();
            $input.on("selecting unselecting change", function() {
                setOption($("#parent_id").parent().find("ul.select2-choices"));

            })
            $parent_id_hide.on("selecting unselecting change", function() {
                $parent = $('#parent_id_hide').find(':selected').val();

            })

            @isset($post)
                @php
                $categoryImplode = "'" . implode("','", $post->categories->pluck('id')->toArray()) . "'";

                @endphp
            @endisset
            $input.val([{!! $categoryImplode ?? '' !!}]);
            $input.trigger('change'); // Notify any JS components that the value changed
            function setOption($this) {
                var $select = $("#parent_id");
                var options;
                options = $select.find("option");
                var newoptions = [];
                // Clear option
                $($this).find(".select2-search-choice").each(function(i, tag) {

                    var $exist = 0;
                    options.each(function(j, option) {
                        var optionTag = '';
                        if ($.trim($(tag).text()) == $.trim($(option).text())) {

                            optionTag = new Option($(tag).text(), $(option).val());
                            if ($(option).val() == $parent) {
                                $exist = 1;
                            }
                            $("#par_idd").append(new Option($(tag).text(), $(option).val()));
                            newoptions.push(optionTag);
                        }

                    });
                });




                $("#parent_id_hide").empty();

                $('#parent_id_hide').select2('destroy');
                $parent_id_hide.select2();
                if (newoptions.length > 0) {
                    $("#parent_id_hide").append(newoptions);
                    $parent_id_hide.val($parent);
                }

                $parent_id_hide.trigger('change'); // Notify any JS components that the value changed




            }
        });
        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });
    </script>

    <script src="/ckeditor4/ckeditor.js"></script>

    <script>


            // CKEDITOR
            // .replace(document.querySelector('#description'), {
            //     ckfinder: {
            //         uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
            //     },
            //     language: 'fa'
            // })
    </script>



@endpush

@section('Content')


    <section class="panel">
        @include('auth.company.nav')

        <div class="list">
            <h1><a href="{{ route('company.products') }}">@lang('messages.products')</a> /
                {{ Request::is('company/products/edit/*') ? __('messages.edit') : '' }}
                @lang('messages.product')
                {{ Request::is('company/products/create') ? __('messages.new') : '' }}

            </h1>

            <form
                action="{{ Request::is('company/products/create') ? route('company.products.store') : route('company.products.edit', $post->id) }}"
                method="POST" name="add_content" enctype="multipart/form-data">
                {{ Request::is('company/products/edit/*') ? method_field('PATCH') : '' }}

                @csrf
                <div class="form-group row sm:mb-2">
                    <div class="col-5 col-md-5 col-xs-12">
                        <label for="name" class="bold">@lang('messages.title'):</label>
                        <input type="text" class="form-control"  name="title" placeholder="مثال: درب ضد سرقت ترک مدل A9"
                        required
                        oninput="this.setCustomValidity('')"
                        oninvalid="this.setCustomValidity('عنوان را وارد نمایید')"
                            value="{{ old('title', $post->title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>



                </div>

                <div class="form-group row sm:mb-3">
                    <div class="col-md-12">
                        <label class="bold" for="description">@lang('messages.description'):</label>
                        <textarea class="form-control" rows="5" placeholder="توضیحات را بنویسید" id="description"
                            name="description">{{ old('description', $post->description ?? '') }}</textarea>
                        <div id="word-count2"></div>
                    </div>


                </div>



                <div class="form-group row sm:mb-3">
                    <div class="col-6 col-md-6 col-xs-12">
                        <label for="category" class="bold">@lang('messages.category'): </label>

                        <div class="font-08 gray">هر چه تعداد دسته بندی های مرتبط بیشتر باشد تبلیغ شما بیشتر دیده میشود</div>
                        <select id="parent_id"  class="js-example-basic-multiple" name="parent_id[]" multiple="multiple"
                        >

                            @foreach ($category as $Key => $fields)
                                <option value="{{ $fields['id'] }}" @if (isset($post->parent_id) && $fields['id'] == $post->parent_id) selected @endif>
                                    {!! $fields['symbol'] . $fields['title'] !!}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                    <div class="col-6 col-md-6 col-xs-12">

                        <label for="parent_id_hide" class="bold">@lang('messages.main category'):</label>
                        <div class="font-08 gray">دسته بندی اصلی محصول را بعد از انتخاب موارد بالا انتخاب نمایید</div>

                        <div id="parent_id_val" class="parent_id_val"></div>
                        <select id="parent_id_hide" name="parent_id_hide">
                            <option value="{!! $post->parent_id ?? '' !!}"></option>
                        </select>

                    </div>
                </div>



                <div class="form-group row sm:mb-4">
                    <div class="col-6 col-sm-6 col-xs-12">
                        <label for="content" class="control-label bold"> @lang('messages.image')</label>
                        <div class="font-09 gray">عرض:{{ env('PRODUCT_LARGE_W') }}px ارتفاع:{{ env('PRODUCT_LARGE_H') }}px</div>
                        <input type="file" class="form-control" name="images" id="images"
                            placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">
                        <input type="hidden" name="imageJson">
                        @php
                            $attr_type = 'product';
                        @endphp
                        @include('auth.company.cropperProduct')

                    </div>

                </div>
                <div class="form-group row ">
                    <div class="col-sm-12" style="display: flex">
                        @if (isset($post) && is_array($post->images))
                            @foreach ($post->images['images'] as $key => $image)
                                <div class="col-sm-2">
                                    <label class="control-label">
                                        {{ $key }}
                                        <input type="radio" name="imagesThumb" value="{{ $image }}"
                                            {{ $post->images['images']['small'] == $image ? 'checked' : '' }} />
                                        <a href="{{ $image }}" target="_blank"><img src="{{ $image }}"
                                                width="100%"></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="form-group row sm:mb-3">
                    <div class="col-md-6 col-xs-12 sm:mb-1">
                        <label for="price" class="bold col-form-label text-md-left">@lang('messages.price') (تومان):</label>
                        <input type="text" class="form-control" name="attr[price]"
                            value="{{ old("attr.price", $post->attr['price']??'') }}" />
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label for="offer_price" class="bold ">@lang('messages.discount')
                            :</label>
                            <div class="font-08 gray">در صورت عدم تخفیف این فیلد را خالی بگذارید</div>
                        <input type="text" class="form-control" placeholder="مبلغ بعد از تخفیف به تومان" name="attr[offer_price]"
                            value="{{ old('attr.offer_price', $post->attr['offer_price']??'') }}" />
                    </div>
                </div>

                <div class="row bg-gray py-2 my-1" >
                    <div class="">ویژگی های محصول</div>
                    @include('admin.attribute.CreateOrEdit')
                </div>





                <button type="submit" class="btn btn-success ">@lang('messages.confirm')
                </button>
            </form>

        </div>
    </section>

@endsection
