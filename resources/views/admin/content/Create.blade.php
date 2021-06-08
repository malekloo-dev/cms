@extends('admin.layouts.app')




@section('ckeditor')


    <script>
        $(document).ready(function() {

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

            $("#parent_id").parent().find("ul.select2-choices").sortable({
                containment: 'parent',
                update: function() {
                    setOption(this)
                },

            });

            @php
            //todo add old value
            //$categoryImplode= "'".implode("','",$content_info->categories->pluck('id')->toArray())."'";
            @endphp
            {{-- $input.val([{!! $categoryImplode !!}]); --}}
            $input.trigger('change'); // Notify any JS components that the value changed
            function setOption($this) {
                var $select = $("#parent_id");
                //$(this).closest(".select2-container").next();
                var options;
                options = $select.find("option");
                //$("#parent_id_hide").empty();
                //var newoptions = '';
                var newoptions = [];
                // Clear option
                $($this).find(".select2-search-choice").each(function(i, tag) {

                    var $exist = 0;
                    options.each(function(j, option) {
                        var optionTag = '';
                        if ($.trim($(tag).text()) == $.trim($(option).text())) {
                            // console.log(option.val());
                            //$("#par_idd").append(new Option($(tag).text(),  $(option).val()));
                            optionTag = new Option($(tag).text(), $(option).val());
                            if ($(option).val() == $parent) {
                                $exist = 1;
                            }
                            $("#par_idd").append(new Option($(tag).text(), $(option).val()));
                            //newoptions=newoptions+','+$(option).val();
                            newoptions.push(optionTag);
                            //$("#par_idd").append(option);
                        }

                    });
                });


                //$parent = $('#parent_id_hide').find(':selected').val();

                $("#parent_id_hide").empty();
                //$('#parent_id_hide option:selected').removeAttr('selected');
                $('#parent_id_hide').select2('destroy');
                $parent_id_hide.select2();
                if (newoptions.length > 0) {
                    $("#parent_id_hide").append(newoptions);
                    $parent_id_hide.val($parent);
                }
                // $parent_id_hide.val($parent);

                //$('#parent_id_hide').select2('destroy');

                //if ($exist != 0) {
                // }
                $parent_id_hide.trigger('change'); // Notify any JS components that the value changed


                //getselector();


            }



        });

        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });

    </script>
<script src="/ckeditor4/ckeditor.js"></script>

    {{-- <script src="/ckeditor5/ckeditor5-build-classic/ckeditor.js"> </script> --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#brief_description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                toolbar: {
                    viewportTopOffset: 80
                },
                @if (!$ltr)
                    language: 'fa'
                @endif
            })
            .then(editor => {
                const wordCountPlugin = editor.plugins.get('WordCount');
                const wordCountWrapper = document.getElementById('word-count1');
                wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

                window.editor = editor;
            })

            .catch(err => {
                console.error(err.stack);
            });


        // ClassicEditor
        //     .create(document.querySelector('#description'), {
        //         ckfinder: {
        //             uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
        //         },
        //         toolbar: {
        //             viewportTopOffset: 80
        //         },
        // @if (!$ltr)
            // language: 'fa'
            // @endif
        //     })
        //     .then(editor => {
        //         const wordCountPlugin = editor.plugins.get('WordCount');
        //         const wordCountWrapper = document.getElementById('word-count2');
        //         wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

        //         window.editor = editor;
        //     })
        //     .catch(err => {
        //         console.error(err.stack);
        //     });

    </script>


@endsection

@section('content')

    <div class="content-control ">
        <ul class="breadcrumb">
            <li><a href="{{ route('contents.type.show', ['type' => $attr_type]) }}" class=""> @lang('messages.'.
                    $attr_type .'s'
                    ) </a></li>
            <li class="active">@lang('messages.add') @lang('messages.'. $attr_type )</li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <form action="{{ route('contents.store') }}" method="POST" name="add_content"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-5 col-md-5">
                            <label for="name" class="col-md-12 col-form-label ">@lang('messages.title'):</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="col-5 col-md-5">
                            <label for="slug">@lang('messages.url') :</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" />
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                        </div>
                        <div class=" col-2 col-md-2">
                            <label for="name"> @lang('messages.publish date'):</label>
                            <input type="{{ $ltr ? 'date' : '' }}"
                                class="form-control {{ !$ltr ? 'datepicker' : 'date' }}  " name="publish_date"
                                value="{{ old('date2', Carbon\Carbon::now()->format('Y-m-d')) }}" />
                        </div>
                    </div>
                    @if (isset($content_info) and $content_info->attr_type == 'html')

                        <div class="form-group row">
                            <label for="brand" class="col-md-12 col-form-label text-md-left">@lang('messages.name')
                                @lang('messages.static template'):</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[template_name]"
                                    value="{{ old('attr[template_name]') }}" />
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name">@lang('messages.brief'):</label>

                            <textarea class="form-control" id="brief_description"
                                name="brief_description">{{ old('brief_description') }}</textarea>
                            <div id="word-count1"></div>
                            {{-- <div id="brief_description">
                            {{ old('brief_description') }}
                        </div> --}}
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name">@lang('messages.description'):</label>
                            {{-- <textarea class="form-control" id="description"name="description">{{ old('description') }}</textarea> --}}
                            <div id="word-count2"></div>
                        </div>

                        <div class="col-md-12">
                            @include('admin.gridMaker')
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-6 col-md-6">
                            <label for="name"> @lang('messages.category'):</label>
                            <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">
                                @foreach ($category as $Key => $fields)
                                    <option value="{{ $fields['id'] }}">{!! $fields['symbol'] . $fields['title'] !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="name">@lang('messages.main category'):</label>

                            <div id="parent_id_val" class="parent_id_val"></div>
                            <select id="parent_id_hide" name="parent_id_hide">
                            </select>
                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6 col-sm-6">
                            <label for="images" class="control-label">@lang('messages.content') @lang('messages.image')
                                (@lang('messages.content') {{ env('ARTICLE_LARGE') }}px)
                                (@lang('messages.product') {{ env('PRODUCT_LARGE') }}px)</label>
                            <input type="file" class="form-control" name="images" id="images"
                                placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">
                            <input type="hidden" name="imageJson">

                            @include('admin.cropper')

                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" />
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label for="name">meta keywords</label>
                            <input id="meta_keywords" type="text" name="meta_keywords"
                                value="{{ old('meta_keywords') }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                            Description:</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="meta_description"
                                name="meta_description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>


                    @if ($attr_type == 'product')

                        <div class="form-group row">
                            <label for="brand"
                                class="col-md-12 col-form-label text-md-left">@lang('messages.brand'):</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[brand]"
                                    value="{{ old('attr[brand]') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price"
                                class="col-md-12 col-form-label text-md-left">@lang('messages.price'):</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[price]"
                                    value="{{ old('attr[price]') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="offer_price"
                                class="col-md-12 col-form-label text-md-left">@lang('messages.discount'):</label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[offer_price]"
                                    value="{{ old('attr[offer_price]') }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alternate_name"
                                class="col-md-12 col-form-label text-md-left">@lang('messages.alternative')
                                @lang('messages.name'):</label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[alternate_name]"
                                    value="{{ old('attr[alternate_name]') }}" />
                            </div>
                        </div>

                    @endif


                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="rate">@lang('messages.rate'):</label>
                            <input type="text" class="form-control" name="attr[rate]" value="{{ old('attr[rate]') }}" />
                        </div>

                        <div class="col-md-3">
                            <label for="name">@lang('messages.status'):</label>
                            <select class="form-control" name="status">
                                <option value="1">@lang('messages.Active')</option>
                                <option value="0">@lang('messages.Disactive')</option>
                            </select>
                        </div>

                    </div>
                    <input type="hidden" name="attr_type" value="{{ $attr_type }}">

                    <button type="submit" class="btn btn-success @if (!$ltr) pull-right @endif mat-btn ">@lang('messages.confirm')
                        </button>
                    </form>
                </div>
            </div>
        </div>

@endsection
