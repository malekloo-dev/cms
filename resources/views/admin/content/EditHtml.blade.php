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
            tags:[],
            maximumInputLength: 100
        });

    </script>

@endsection


<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">Edit</a></li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <form method="post" action="{{ route('contents.update', $content_info->id) }}"enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Enter Title:</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title',$content_info->title) }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left"> Append Header:</label>
                    <div class="col-md-12">
                        <textarea rows="5" class="form-control" id="append_header'" name="attr[append_header]">{{ old('attr[append_header]',$content_info->attr['append_header']) }}</textarea>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Description:</label>
                    <div class="col-md-12">
                        <textarea rows="30" class="form-control" id="description" name="description">{{ old('description',$content_info->description) }}</textarea>

                    </div>

                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Append Footer:</label>
                    <div class="col-md-12">
                        <textarea rows="5" class="form-control" id="append_footer'" name="attr[append_footer]">{{ old('attr[append_footer]',$content_info->attr['append_footer']) }}</textarea>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Category</label>
                    <div class="col-md-12">
                        {{--<select multiple name="parent_id" id="parent_id" class="form-control" >--}}
                        <select id="parent_id"  class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">


                            @foreach($category as $Key => $fields)
                                <option value="{{$fields['id']}}" {{ $content_info->parent_id == $fields['id'] ? 'selected' : '' }} >{!! $fields['symbol'].$fields['title']!!}</option>
                            @endforeach
                        </select>
                        <div id="parent_id_val" class="parent_id_val"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">meta keywords</label>
                    <div class="col-md-12">
                        <input id="meta_keywords" type="text" name="meta_keywords"
                               value="{{ old('meta_keywords',$content_info->meta_keywords) }}" />
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Publish Date:</label>
                    <div class="col-md-12">
                        <input type="datetime" class="form-control datepicker" name="publish_date"
                               value="{{ old('publish_date',$content_info->publish_date) }}" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">تصویر مقاله (سایز مقاله {{ env('ARTICLE_LARGE') }}px) (سایز محصول {{ env('PRODUCT_LARGE') }}px)</label>
                        <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید" value="{{ old('imageUrl') }}">
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="row">

                        <?php  //dd($content_info->images); ?>

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


                    <div class="form-group">
                        <div class="col-sm-6">
                            <br/>  <br/> <br/>  <br/>
                            <br/>  <br/> <br/>  <br/>
                            <br/>  <br/> <br/>  <br/>

                        </div>

                    </div>


                <div class="form-group row">
                    <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                        Description:</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description',$content_info->meta_description) }}</textarea>
                    </div>

                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Status:</label>
                    <div class="col-md-12">
                        <select class="form-control" name="status" >
                            <option value="1" {{ $content_info->status == '1' ? 'selected' : '' }}>فعال</option>
                            <option value="0"{{ $content_info->status == '0' ? 'selected' : '' }}>غیر فعال</option>
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Edit
                    Content
                </button>
                <a href="{{ route('contents.index')  }}" class="link ">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </form>
        </div>
    </div>
</div>

@endsection


<span class="text-danger">{{ $errors->first('brief_description') }}</span>
<span class="text-danger">{{ $errors->first('description') }}</span>
<span class="text-danger">{{ $errors->first('status') }}</span>
<span class="text-danger">{{ $errors->first('publish_date') }}</span>
