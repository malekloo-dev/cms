@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.Redirect Url')</li>
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
                <div class="ckfinder-widget"></div>
                <script type="text/javascript" src="{{ url('adminAssets/js/ckfinder/ckfinder.js') }}"></script>
                <script>
                    CKFinder.config({
                        connectorPath: @json(route('ckfinder_connector'))
                    });

                </script>

                <script>
                    CKFinder.start();
                    CKFinder.widget('ckfinder-widget', {
                        width: '100%',
                        height: 700
                    });

                </script>

            </div>
        </div>
    </div>

@endsection
