@extends('admin.layouts.app')
@section('content')
@section('ckeditor')


    <script>
        $(document).ready(function() {

            var $input = $("#parent_id");
            $input.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });



        });

        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });

    </script>


    <script src="/ckeditor5/ckeditor5-build-classic/ckeditor.js"> </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#brief_description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                toolbar: {
                    viewportTopOffset: 80
                },
                @if(!$ltr)
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


        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                toolbar: {
                    viewportTopOffset: 80
                },
                @if(!$ltr)
                language: 'fa'
                @endif
            })
            .then(editor => {
                const wordCountPlugin = editor.plugins.get('WordCount');
                const wordCountWrapper = document.getElementById('word-count2');
                wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });

    </script>





@endsection



<div class="content-control">
    <ul class="breadcrumb">
        <li><a href="{{ route('contents.show', ['type' => $content_info->attr_type]) }}" class=""> @lang('messages.'.
                $content_info->attr_type .'s' ) </a></li>
        <li class="active">@lang('messages.edit') {{ old('title', $content_info->title) }}</li>
    </ul>
</div>


<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <form method="post" action="{{ route('contents.update', $content_info->id) }}"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="title" class=" col-form-label text-md-left">@lang('messages.title'):</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $content_info->title) }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="col-md-5">
                        <label for="slug" class=" col-form-label text-md-left">@lang('messages.url') :</label>
                        <input type="text" class="form-control" name="slug"
                            value="{{ old('slug', $content_info->slug) }}" />
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="col-md-2">
                        <label for="name">@lang('messages.publish date') :</label>
                        <input  type="{{ ($ltr)?'date':'' }}" class="form-control @if(!$ltr) datepicker @endif" name="publish_date"
                            value="{{ old('publish_date', $content_info->publish_date) }}" />
                    </div>
                </div>
                @if ($content_info->attr_type == 'html')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.static template') @lang('messages.name'):</label>
                            <input type="text" class="form-control" name="attr[template_name]"
                                value="{{ old('attr[template_name]', $content_info->attr['template_name']) }}" />

                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.brief'):</label>

                        <textarea class="form-control" id="brief_description" name="brief_description" rows="10"
                            placeholder="Enter your Content">{{ old('brief_description', $content_info->brief_description) }}</textarea>
                        <div id="word-count1"></div>
                        <span class="text-danger">{{ $errors->first('brief_description') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.description'):</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description', $content_info->description) }}</textarea>
                        <div id="word-count2"></div>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name" >@lang('messages.category'):</label>
                        {{--<select multiple name="parent_id" id="parent_id"
                            class="form-control">--}}
                            <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]"
                                multiple="multiple">

                                @foreach ($category as $Key => $fields)
                                    <option value="{{ $fields['id'] }}"
                                        {{ $content_info->parent_id == $fields['id'] ? 'selected' : '' }}>{!!
                                        $fields['symbol'] . $fields['title'] !!}</option>
                                @endforeach
                            </select>
                            <div id="parent_id_val" class="parent_id_val"></div>
                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">@lang('messages.image') (@lang('messages.content') {{ env('ARTICLE_LARGE') }}px)
                            (@lang('messages.product') {{ env('PRODUCT_LARGE') }}px)</label>
                        <input type="file" class="form-control" name="images" id="images"
                            placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        @if (is_array($content_info->images))
                            @foreach ($content_info->images['images'] as $key => $image)
                                <div class="col-sm-2">
                                    <label class="control-label">
                                        {{ $key }}
                                        <input type="radio" name="imagesThumb" value="{{ $image }}"
                                            {{ $content_info->images['thumb'] == $image ? 'checked' : '' }} />
                                        <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title"
                            value="{{ old('meta_keywords', $content_info->meta_title) }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class=" text-md-left">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $content_info->meta_keywords) }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class=" col-form-label text-md-left">meta
                            Description:</label>
                        <textarea class="form-control" id="meta_description"
                            name="meta_description">{{ old('meta_description', $content_info->meta_description) }}</textarea>
                    </div>

                </div>


                @if ($content_info->attr_type == 'product')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.brand'):</label>
                            <input type="text" class="form-control" name="attr[brand]"
                                value="{{ old('attr[brand]', $content_info->attr['brand']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="price" class=" col-form-label text-md-left">@lang('messages.price'):</label>
                            <input type="text" class="form-control" name="attr[price]"
                                value="{{ old('attr[price]', $content_info->attr['price']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="offer_price" class=" col-form-label text-md-left">@lang('messages.discount'):</label>

                            <input type="text" class="form-control" name="attr[offer_price]"
                                value="{{ old('attr[offer_price]', $content_info->attr['offer_price']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="alternate_name" class=" col-form-label text-md-left">@lang('messages.alternative') @lang('messages.name'):</label>

                            <input type="text" class="form-control" name="attr[alternate_name]"
                                value="{{ old('attr[alternate_name]', $content_info->attr['alternate_name'] ?? '') }}" />
                        </div>
                    </div>

                @endif
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="rate" class="col-form-label text-md-left">@lang('messages.rate'):</label>

                        <input type="text" class="form-control" name="attr[rate]"
                            value="{{ old('attr[rate]', $content_info->attr['rate'] ?? '') }}" />
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="col-form-label text-md-left">@lang('messages.status'):</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $content_info->status == '1' ? 'selected' : '' }}>@lang('messages.Active')</option>
                            <option value="0" {{ $content_info->status == '0' ? 'selected' : '' }}>@lang('messages.Disactive')</option>
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-success  @if(!$ltr)pull-right @endif mat-btn ">@lang('messages.edit')
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
