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
</script>
@endsection

<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">افزودن </a></li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            
            <form action="{{ route('seo.redirectUrl.store') }}" method="POST">
                @csrf
                <div class="form-group row">

                    <div class="col-md-6">
                        <label for="url" class="col-form-label ">url:</label>
                        <input type="text" class="form-control ltr text-left" name="url" value="{{ old('url') }}" />
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    </div>


                    <div class="col-md-6">
                        <label for="redirect_to" class=" col-form-label ">Redirect to:</label>
                        <input type="text" class="form-control ltr text-left" name="redirect_to" value="{{ old('redirect_to') }}" />
                        <span class="text-danger">{{ $errors->first('redirect_to') }}</span>
                    </div>

                </div>
                <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">تایید
                </button>
                <a href="{{ route('seo.redirectUrl.index') }}" class="link ">
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
