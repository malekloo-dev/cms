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
            <li><a  class="text-18">Add</a></li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <form action="{{ route('contents.store') }}" method="POST" name="add_content" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Enter Title:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title') }}" />
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"> template name:</label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" id="append_header'" name="attr[template_name]">{{ old('attr[template_name]') }}</textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Description:</label>
                        <div class="col-md-12">
                            <textarea rows="30" class="form-control"   id="description" name="description">{{ old('description') }}</textarea>

                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Append Footer:</label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" id="append_footer'" name="attr[append_footer]">{{ old('attr[append_footer]') }}</textarea>
                        </div>

                    </div>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Category</label>
                        <div class="col-md-12">
                            {{--<select multiple name="parent_id" id="parent_id" class="form-control" >--}}
                                <select id="parent_id"  class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">

                                @foreach($category as $Key => $fields)
                                    <option value="{{$fields['id']}}">{!! $fields['symbol'].$fields['title']!!}</option>
                                @endforeach
                            </select>
                            <div id="parent_id_val" class="parent_id_val"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">meta keywords</label>
                        <div class="col-md-12">
                            <input id="meta_keywords" type="text" name="meta_keywords"
                                   value="{{ old('meta_keywords') }}" />
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Publish Date:</label>
                        <div class="col-md-12">
                            <input type="datetime" class="form-control" name="publish_date"
                                   value = "{{ old('date2',Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="images" class="control-label">تصویر مقاله</label>
                            <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید" value="{{ old('imageUrl') }}">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                            Description:</label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Status:</label>
                        <div class="col-md-12">
                            <select class="form-control" name="status" >
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="attr_type" value="{{ $attr_type }}">

                    <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Add Content</button>
                    <a href="{{ old('publish_date') }}" class="link ">
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


