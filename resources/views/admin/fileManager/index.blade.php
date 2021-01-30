@extends('admin.layouts.app')
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
                {{-- <link href="{{ url('/ckfinder/samples/css/sample.css') }}" rel="stylesheet"> --}}

                <div id="ckfinder-widget"></div>
                {{-- <script src="{{ url('/ckfinder/samples/js/sf.js') }}"></script> --}}
                {{-- <script src="{{ url('/ckfinder/samples/js/tree-a.js') }}"></script> --}}
                <script type="text/javascript" src="{{ url('/ckfinder/ckfinder.js') }}"></script>
                <script>
                    CKFinder.config({
                        connectorPath: @json(route('ckfinder_connector'))
                    });
                </script>
                <script>
                    CKFinder.widget('ckfinder-widget', {
                        // language:'fa',
                        width: '100%',
                        height: 700
                    });

                </script>

                {{-- <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script> --}}



            </div>
        </div>
    </div>

@endsection
