@extends('admin.layouts.app')
@section('content')
@section('ckeditor')
    <script>
        /*  $(document).ready(function() {
            var $input = $("#parent_id");
            $input.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });
        }); */

    </script>
@endsection

<div class="content-control">
    <ul class="breadcrumb">
        <li class="active">@lang('messages.website setting')</li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">

            <form action="{{ route('seo.websiteSetting.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_title" class="col-form-label ">Meta title:</label>
                        <input type="text" class="form-control " name="meta_title" value="{{ $data['meta_title'] }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_keywords" class=" col-form-label ">Meta keyword:</label>
                        <input type="text" class="form-control " name="meta_keywords"
                            value="{{ $data['meta_keywords'] }}" />
                        <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class=" col-form-label ">Meta description:</label>
                        <input type="text" class="form-control " name="meta_description"
                            value="{{ $data['meta_description'] }}" />
                        <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success pull-right mat-btn ">@lang('messages.confirm')
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
