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
        <li><a href="{{ route('role.permissions.index', $role->id) }}">{{ ucfirst($role->name) }}
                @lang('messages.permission')</a></li>
        <li class="active">@lang('messages.add')</li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default  pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <form action="{{ route('role.permission.store', $role->id) }}" method="POST">

                @csrf
                <div class="form-group row">

                    <div class="col-md-6">
                        <label for="url" class="col-form-label ">@lang('messages.name'):</label>
                        <input type="text" placeholder="" class="form-control" name="name"
                            value="{{ old('name') }}" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">@lang('messages.confirm')</button>
            </form>
        </div>
    </div>
</div>

@endsection
