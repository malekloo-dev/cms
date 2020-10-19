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
                uploadUrl: "{{route('contents.upload', ['_token' => csrf_token() ])}}",
            },
            toolbar: {
                viewportTopOffset: 80
            },
            language: 'fa'
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
                uploadUrl: "{{route('contents.upload', ['_token' => csrf_token() ])}}",
            },
            toolbar: {
                viewportTopOffset: 80
            },
            language: 'fa'
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
        <li><a class="text-18">ویرایش {{ old('title',$content_info->title) }}</a></li>
    </ul>
</div>


<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <form method="post" action="{{ route('contents.update', $content_info->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="title" class=" col-form-label text-md-left">عنوان:</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title',$content_info->title) }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="slug" class=" col-form-label text-md-left">آدرس صفحه :</label>
                        <input type="text" class="form-control" name="slug" value="{{ old('slug',$content_info->slug) }}" />
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>
                </div>
                @if ($content_info->attr_type=='html')

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="brand" class=" col-form-label text-md-left">نام قالب استاتیک:</label>
                        <input type="text" class="form-control" name="attr[template_name]" value="{{ old('attr[template_name]',$content_info->attr['template_name']) }}" />

                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">توضیحات مختصر:</label>

                        <textarea class="form-control" id="brief_description" name="brief_description" rows="10" placeholder="Enter your Content">{{ old('brief_description',$content_info->brief_description) }}</textarea>
                        <div id="word-count1"></div>
                        <span class="text-danger">{{ $errors->first('brief_description') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">توضیحات:</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description',$content_info->description) }}</textarea>
                        <div id="word-count2"></div>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">دسته بندی:</label>
                        {{--<select multiple name="parent_id" id="parent_id" class="form-control" >--}}
                        <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">


                            @foreach($category as $Key => $fields)
                            <option value="{{$fields['id']}}" {{ $content_info->parent_id == $fields['id'] ? 'selected' : '' }}>{!! $fields['symbol'].$fields['title']!!}</option>
                            @endforeach
                        </select>
                        <div id="parent_id_val" class="parent_id_val"></div>
                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                </div>




                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class="col-form-label text-md-left">تاریخ انتشار:</label>
                        <input type="" class="form-control datepicker" name="publish_date" value="{{ old('publish_date',$content_info->publish_date) }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">تصویر مقاله (سایز مقاله {{ env('ARTICLE_LARGE') }}px) (سایز محصول {{ env('PRODUCT_LARGE') }}px)</label>
                        <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید" value="{{ old('imageUrl') }}">
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-sm-12">

                        <?php  //dd($content_info->images);
                        ?>

                        @if(is_array($content_info->images))

                        @foreach( $content_info->images['images'] as $key => $image)
                        <div class="col-sm-2">
                            <label class="control-label">
                                {{ $key }}
                                <input type="radio" name="imagesThumb" value="{{ $image }}" {{ $content_info->images['thumb'] == $image ? 'checked' : '' }} />
                                <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                            </label>
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="meta_title" class="col-md-12 col-form-label ">Meta Title</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="meta_title" value="{{ old('meta_keywords',$content_info->meta_title) }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords" value="{{ old('meta_keywords',$content_info->meta_keywords) }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class=" col-form-label text-md-left">meta
                            Description:</label>
                        <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description',$content_info->meta_description) }}</textarea>
                    </div>

                </div>


                @if ($content_info->attr_type=='product')

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="brand" class=" col-form-label text-md-left">برند:</label>
                        <input type="text" class="form-control" name="attr[brand]" value="{{ old('attr[brand]',$content_info->attr['brand'])}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="price" class=" col-form-label text-md-left">قیمت:</label>
                        <input type="text" class="form-control" name="attr[price]" value="{{ old('attr[price]',$content_info->attr['price']) }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="offer_price" class=" col-form-label text-md-left">offer_price:</label>

                        <input type="text" class="form-control" name="attr[offer_price]" value="{{ old('attr[offer_price]',$content_info->attr['offer_price']) }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="alternate_name" class=" col-form-label text-md-left">نام جایگزین:</label>

                        <input type="text" class="form-control" name="attr[alternate_name]" value="{{ old('attr[alternate_name]',$content_info->attr['alternate_name']) }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="rate" class="col-form-label text-md-left">رتبه:</label>

                        <input type="text" class="form-control" name="attr[rate]" value="{{ old('attr[rate]',$content_info->attr['rate']) }}" />
                    </div>
                </div>
                @endif


                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="name" class="col-form-label text-md-left">وضعیت:</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $content_info->status == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $content_info->status == '0' ? 'selected' : '' }}>غیر فعال</option>
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Edit
                    Content
                </button>
                <a href="{{ route('contents.index') .'/'.$content_info->attr_type }}" class="btn link ">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </form>
        </div>
    </div>
</div>

@endsection
