@extends('admin.layouts.app')
@section('content')
@section('ckeditor')

<script>
    /*$(document).ready(function() { $("#parent_id").select2(); });

         $("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});

         $("#parent_id").select2("container").find("ul.select2-choices").sortable({
         containment: 'parent',
         start: function() { $("#parent_id").select2("onSortStart"); },
         update: function() { $("#parent_id").select2("onSortEnd"); }
         });*/


        $(document).ready(function() {

            var $input = $("#parent_id");
            $input.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });


            /*$("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});
             $("#parent_id").select2("container").find("ul.select2-choices").sortable({
             containment: 'parent',
             start: function() { $("#parent_id").select2("onSortStart"); },
             update: function() { $("#parent_id").select2("onSortEnd"); }
             });*/

        });

        $("#meta_keywords").select2({
            tags:[],
            maximumInputLength: 100
        });



</script>


<script src="/ckeditor5/ckeditor.js"> </script>
<script>
    ClassicEditor
            .create( document.querySelector('#brief_description'),{
                ckfinder: {
                    uploadUrl: "{{route('contents.upload', ['_token' => csrf_token() ])}}",
                },
                alignment: {
                    options: [ 'left', 'right' ]
                },

                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'fa'
                },

                /*toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'imageUpload','numberedList' ,'alignment','undo', 'redo','blockQuote' ],
                 blockToolbar: [
                 'paragraph', 'heading1', 'heading2', 'heading3',
                 '|',
                 'blockQuote', 'imageUpload'
                 ,'alignment','undo', 'redo',
                 '|',
                 'bulletedList', 'numberedList',
                 '|'

                 ],*/


                image: {
                    // You need to configure the image toolbar, too, so it uses the new style buttons.
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight','imageStyle:alignCenter' ],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight',
                        'alignCenter'

                    ]
                }
            } )
            .then( editor => {
            window.editor = editor;
        } )

        .catch( err => {
            console.error( err.stack );
        } );

        ClassicEditor
            .create( document.querySelector('#description'),{
                ckfinder: {
                    uploadUrl: "{{route('contents.upload', ['_token' => csrf_token() ])}}",
                },
                alignment: {
                    options: [ 'left', 'right' ]
                },

                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'fa'
                },

                /*toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'imageUpload','numberedList' ,'alignment','undo', 'redo','blockQuote' ],
                 blockToolbar: [
                 'paragraph', 'heading1', 'heading2', 'heading3',
                 '|',
                 'blockQuote', 'imageUpload'
                 ,'alignment','undo', 'redo',
                 '|',
                 'bulletedList', 'numberedList',
                 '|'

                 ],*/


                image: {
                    // You need to configure the image toolbar, too, so it uses the new style buttons.
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight','imageStyle:alignCenter' ],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight',
                        'alignCenter'

                    ]
                }
            } )
            .then( editor => {
            window.editor = editor;
        } )

        .catch( err => {
            console.error( err.stack );
        } );
</script>


@endsection


<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">Add</a></li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <form action="{{ route('category.store') }}" method="POST" name="add_content" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name" class="col-form-label text-md-left">Enter Title:</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>

                    @if ($attr_type=='html')

                        <div class="form-group row">
                            <label for="brand" class="col-md-12 col-form-label text-md-left">template name:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[template_name]" value="{{ old('attr[template_name]') }}"/>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <label for="name" class="col-form-label text-md-left">Category</label>
                        <select name="parent_id" id="parent_id" {{--class="form-control"--}}>
                            <option value="0">مادر</option>

                            @foreach($category as $Key => $fields)
                            <option value="{{$fields['id']}}">{!! $fields['symbol'].$fields['title']!!}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class="col-form-label text-md-left">Brief Description:</label>
                        <textarea class="form-control" id="brief_description"
                            name="brief_description">{{ old('brief_description') }}</textarea>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">Description:</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description') }}</textarea>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="name" class="col-form-label text-md-left">Publish Date:</label>
                        <input type="datetime" class="form-control" name="publish_date"
                            value="{{ old('date2',Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}" />
                    </div>
                    <div class="col-md-3">
                        <label for="name" class=" col-form-label text-md-left">Status:</label>
                        <select class="select2" name="status">
                            <option value="1">فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">تصویر </label>
                        <input type="file" class="form-control" name="images" id="images"
                            placeholder="تصویر  را وارد کنید" value="{{ old('imageUrl') }}">
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class="col-form-label text-md-left">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class="col-form-label text-md-left">meta Description:</label>
                        <textarea class="form-control" id="meta_description"
                            name="meta_description">{{ old('meta_description') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Add
                    Content</button>
                <a href="{{ old('publish_date') }}" class="link ">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
                <input type="hidden" name="attr_type" value="{{ $attr_type }}">

            </form>
        </div>
    </div>
</div>

@endsection


<span class="text-danger">{{ $errors->first('brief_description') }}</span>
<span class="text-danger">{{ $errors->first('description') }}</span>
<span class="text-danger">{{ $errors->first('status') }}</span>
<span class="text-danger">{{ $errors->first('publish_date') }}</span>
