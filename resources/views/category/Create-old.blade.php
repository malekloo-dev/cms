@extends('layouts.app')
@section('content')
@section('ckeditor')

    <script>
        $(document).ready(function() { $("#parent_id").select2(); });
    </script>


    <script src="/ckeditor5/ckeditor.js" > </script>
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
                link: {
                    addTargetToExternalLinks: true,
                    anchor: true,
                    title: true,
                    relNofollow: true,
                    targetBlank: true
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
                    <label for="name" class="col-md-12 col-form-label text-md-left">Enter Title:</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title') }}"/>
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Brief Description:</label>
                    <div class="col-md-12">

                            <textarea class="form-control" id="brief_description" name="brief_description"
                                      value="{{ old('brief_description') }}"></textarea>

                        {{--<div id="brief_description">
                            {{ old('brief_description') }}
                        </div>--}}
                    </div>

                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Description:</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="description" name="description"
                                  value="{{ old('description') }}"></textarea>


                    </div>

                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Category</label>
                    <div class="col-md-12">
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">مادر</option>

                            @foreach($category as $Key => $fields)
                                <option value="{{$fields['id']}}">{!! $fields['symbol'].$fields['title']!!}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                {{-- <select multiple="multiple" name="sports[]" id="sports">
                     @foreach($aSports as $aKey => $aSport)
                         @foreach($aItem->sports as $aItemKey => $aItemSport)
                             <option value="{{$aKey}}" @if($aKey == $aItemKey)selected="selected"@endif>{{$aSport}}</option>
                         @endforeach
                     @endforeach
                 </select>--}}

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">meta keywords</label>
                    <div class="col-md-12">
                        <input id="meta_keywords" type="text" {{--class="form-control"--}} name="meta_keywords"
                               value="{{ old('meta_keywords') }}"/>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Publish Date:</label>
                    <div class="col-md-12">
                        <input type="datetime" class="form-control" name="publish_date"
                               value="{{ old('publish_date') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">تصویر مقاله</label>
                        <input type="file" class="form-control" name="images" id="images"
                               placeholder="تصویر مقاله را وارد کنید" value="{{ old('imageUrl') }}">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                        Description:</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="meta_description" name="meta_description"
                                  value="{{ old('meta_description') }}"></textarea>

                    </div>

                </div>


                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label text-md-left">Status:</label>
                    <div class="col-md-12">
                        <select class="form-control" name="status">
                            <option value="1">فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Add
                    Content
                </button>
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


