@extends('admin.layouts.app')
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

    <script src="/ckeditor4/ckeditor.js"></script>

    <script>
        CKEDITOR
            .replace(document.querySelector('#brief_description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                @if (!$ltr)
                    language: 'fa'
                @endif
            })
        // .then(editor => {
        //     const wordCountPlugin = editor.plugins.get('WordCount');
        //     const wordCountWrapper = document.getElementById('word-count1');
        //     wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

        //     window.editor = editor;
        // })

        // .catch(err => {
        //     console.error(err.stack);
        // });
    </script>
@endsection

@section('content')

    @php
        $template = '';
        if (Request()->get('template')) {
            $template = Request()->get('template');
        }
        if (isset($content->attr['template_name'])) {
            $template = $content->attr['template_name'];
        }
        $attr_type = 'category';
    @endphp


    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('category.index') }}">@lang('messages.category')</a></li>
            <li class="active">
                @if (Request()->is('*create*'))
                    @lang('messages.add')
                @else
                    @lang('messages.edit') {{ old('title', $content->title) }}
                @endif
            </li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <form method="post"
                    @if (Request()->is('*create*')) action=" {{ route('category.store') }}" enctype="multipart/form-data">
                @else
                        action="   {{ route('category.update', $content->id) }}" enctype="multipart/form-data">
                        @method('PATCH') @endif
                    @csrf <div class="form-group row">
                    <div class="col-5 col-md-5">
                        <label for="name" class=" col-form-label">@lang('messages.title'):</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $content->title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>

                    <div class="col-5 col-md-5">
                        <label for="slug" class="col-form-label text-md-left">@lang('messages.url') :</label>
                        <div class="row ltr" style="display: flex">

                            <input type="text" class="form-control ltr" style="width: 79px; border-radius:0" name="prefix" placeholder="category/"  value="{{ $content->prefix ?? '' }}">
                            <input type="text" class="form-control ltr" style="border-radius:0; border-left:0;" name="slug"
                                value="{{ old('slug', $content->slug ?? '') }}" />

                        </div>


                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>


                    <div class="col-2 col-md-2">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.publish date'):</label>
                        <input type="{{ $ltr ? 'date' : 'datetime' }}"
                            class="form-control @if (!$ltr) datepicker @endif" name="publish_date"
                            value="{{ old('publish_date', $content->publish_date ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('publish_date') }}</span>

                    </div>

            </div>



            {{-- @if (isset($template) && $template != '') --}}
                <div class="form-group row">
                    <label for="brand" class="col-md-12 col-form-label text-md-left">@lang('messages.static template')
                        @lang('messages.name')(exp:Contact):</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="attr[template_name]"
                            value="{{ old('attr[template_name]', $content->attr['template_name'] ?? '') }}" />
                    </div>
                </div>
            {{-- @endif --}}

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="name" class="col-form-label text-md-left">@lang('messages.brief'):</label>
                    <textarea class="form-control" id="brief_description" name="brief_description" rows="10"
                        placeholder="Enter your Content">{{ old('brief_description', $content->brief_description ?? '') }}</textarea>
                    <div id="word-count1"></div>
                </div>

            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="name" class=" col-form-label text-md-left">@lang('messages.description'):</label>
                </div>
                <div class="col-md-12">
                    @include('admin.gridMaker')
                </div>

            </div>


            <div class="form-group row">
                <div class="col-6 col-md-6">
                    <label for="name" class=" col-form-label text-md-left">@lang('messages.category')</label>

                    <select name="parent_id" id="parent_id">

                        <option value="0" {{ ($content->parent_id ?? '') == 0 ? 'selected' : '' }}>
                            @lang('messages.parent')</option>
                        @foreach ($category as $Key => $fields)
                            <option value="{{ $fields['id'] }}"
                                {{ ($content->parent_id ?? '') == $fields['id'] ? 'selected' : '' }}>
                                {!! $fields['symbol'] . $fields['title'] !!}</option>
                        @endforeach
                    </select>


                    <div id="parent_id_val" class="parent_id_val"></div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-6 col-md-6">
                    <label for="images" class="control-label">@lang('messages.image')
                        (@lang('messages.size'){{ env('CATEGORY_LARGE') }}px)</label>
                    <input type="file" class="form-control" name="images" id="images"
                        placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">


                    @include('admin.cropper')

                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    @if (is_array($content->images ?? ''))
                        <div class="row">
                            @foreach ($content->images['images'] as $key => $image)
                                <div class="col-2 col-sm-2">
                                    <label class="control-label" style="display: inline">
                                        {{ $key }}
                                        <a href="{{ $image }}" target="_blank">
                                            <img src="{{ $image }}"
                                                width="{{ (env('CATEGORY_' . Str::upper($key) . '_W') ?? env('CATEGORY_LARGE_W')) / 4 }}">
                                        </a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>





            <div class="form-group row">
                <div class="col-md-6">
                    <label for="meta_title" class=" col-form-label ">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title"
                        value="{{ old('meta_title', $content->meta_title ?? '') }}" />
                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                </div>

                <div class="col-md-6">
                    <label for="name" class=" col-form-label text-md-left">meta keywords</label>
                    <input id="meta_keywords" type="text" name="meta_keywords"
                        value="{{ old('meta_keywords', $content->meta_keywords ?? '') }}" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="meta_description" class=" col-form-label text-md-left">meta Description:</label>
                    <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $content->meta_description ?? '') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="name" class=" col-form-label text-md-left">@lang('messages.status'):</label>
                    <select class=" select2" name="status">
                        <option value="1" {{ ($content->status ?? '') == '1' ? 'selected' : '' }}>
                            @lang('messages.Active')</option>
                        <option value="0" {{ ($content->status ?? '') == '0' ? 'selected' : '' }}>
                            @lang('messages.Disactive')</option>
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">
                @if (Request()->is('*create*'))
                    @lang('messages.add')
                @else
                    @lang('messages.edit')
                @endif
            </button>
            </form>
        </div>
    </div>
    </div>


    <style>
        #cropperPreview,
        #cropperPreviewPng {
            width: {{ env('CATEGORY_SMALL_W') }}px !important
        }
    </style>
@endsection
