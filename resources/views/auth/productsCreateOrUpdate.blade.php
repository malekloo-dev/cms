@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="panel">
        @include('auth.nav')

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
                <div class="form-group row">
                    <div class="col-5 col-md-5 col-xs-12">
                        <label for="name" class="">@lang('messages.title'):</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $post->title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    {{-- <div class="col-5 col-md-5 col-xs-12">
                        <label for="slug">@lang('messages.url') :</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" />
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div> --}}
                    <div class=" col-2 col-md-2 col-xs-12">
                        <label for="name"> @lang('messages.publish date'):</label>
                        <input type="{{ $ltr ? 'date' : '' }}"
                            class="form-control {{ !$ltr ? 'datepicker' : 'date' }}  " name="publish_date"
                            value="{{ old('publish_date', Carbon\Carbon::now()->format('Y-m-d')) }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name">@lang('messages.brief'):</label>

                        <textarea class="form-control" id="brief_description"
                            name="brief_description">{{ old('brief_description', $post->brief_description ?? '') }}</textarea>
                        <div id="word-count1"></div>
                        {{-- <div id="brief_description">
                            {{ old('brief_description') }}
                        </div> --}}
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name">@lang('messages.description'):</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description', $post->description ?? '') }}</textarea>
                        <div id="word-count2"></div>
                    </div>

                    <div class="col-md-12">
                        {{-- @include('admin.gridMaker') --}}
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name"> @lang('messages.category'):</label>

                        <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">
                            @foreach ($category as $Key => $fields)
                                <option value="{{ $fields['id'] }}" @if (isset($post->parent_id) && $fields['id'] == $post->parent_id ) selected @endif>
                                    {!! $fields['symbol'] . $fields['title'] !!}
                                </option>
                            @endforeach
                        </select>
                        <div id="parent_id_val" class="parent_id_val"></div>
                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6 col-sm-6 col-xs-12">
                        <label for="images" class="control-label">@lang('messages.content') @lang('messages.image')
                            (@lang('messages.content') {{ env('ARTICLE_LARGE') }}px)
                            (@lang('messages.product') {{ env('PRODUCT_LARGE') }}px)</label>
                        <input type="file" class="form-control" name="images" id="images"
                            placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">
                        <input type="hidden" name="imageJson">

                        @include('admin.cropper')

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
                                            {{ $post->images['thumb'] == $image ? 'checked' : '' }} />
                                        <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title"
                            value="{{ old('meta_title', $post->meta_title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="name">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $post->meta_keywords ?? '') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta Description:</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="meta_description"
                            name="meta_description">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success ">@lang('messages.confirm')
                </button>
            </form>

        </div>
    </section>

@endsection

@section('footer')

    <link href="https://lcms.ir/adminAssets/css/persian-datepicker.min.css" rel="stylesheet">
    <script src="https://lcms.ir/adminAssets/js/persian-datepicker.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script src="{{ url('adminAssets/js/select2.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {

            var $input = $("#parent_id");
            $input.select2();
            // $("ul.select2-choices").sortable({
            //     containment: 'parent'
            // });

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

        });

        // $("#meta_keywords").select2({
        //     tags: [],
        //     maximumInputLength: 100
        // });

    </script>
@endsection
