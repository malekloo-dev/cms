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

            ClassicEditor.replace('brief_description', {filebrowserImageBrowseUrl: '/admin/file-manager/ckeditor'});



    </script>





@endsection


@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.file manager')</li>
        </ul>
        <div>
            {{-- <a href="{{ route('seo.redirectUrl.create') }}"
                class="btn btn-success btn-icon mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add')
            </a> --}}
        </div>

    </div>

    <div class="content-body">
        <div class="panel panel-default  pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif

                <meta name="csrf-token" content="{{ csrf_token() }}">

                {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"> --}}
                {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
                <link rel="stylesheet" href="{{ url('/vendor/file-manager/css/file-manager.css') }}">
                <script src="{{ url('/vendor/file-manager/js/file-manager.js') }}"></script>


                <div style="height: 600px;">
                    <div id="brief_description"></div>
                </div>


            </div>
        </div>
    </div>

@endsection
