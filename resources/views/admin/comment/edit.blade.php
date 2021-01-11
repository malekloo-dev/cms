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
<script src="/ckeditor5/ckeditor5-build-classic/ckeditor.js"> </script>
<script>
    ClassicEditor
        .create(document.querySelector('#comment'), {
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
</script>

@endsection

<div class="content-control">
    <ul class="breadcrumb">
        <li><a href="{{ route('comment.index') }}">@lang('messages.Comments')</a></li>
        <li>@lang('messages.edit') </li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <div class="">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <form action="{{ route('comment.update', $data->id) }}" method="POST">
                    <input type="hidden" name="content_id" value="{{ $data->content->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="col-form-label">@lang('messages.date'):</label>
                            {{ convertGToJ($data->created_at) }}
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label text-md-left">@lang('messages.content'):</label>
                            <a target="_blank" href="{{ url($data->content->slug) }}">
                                {{ $data->content->title }}
                                <i class="fa fa-external-link"></i>
                            </a>
                        </div>
                        <div class="col-md-2">
                            @for ($i = $data->rate; $i >= 1; $i--)
                                <img width="20" height="20" src="{{ url('adminAssets/img/star1x.png') }}"
                                    alt="{{ 'star for rating' }}">
                            @endfor
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="name" class=" col-form-label">@lang('messages.name') :</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $data->name) }}" />
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="col-md-2">
                            <label for="name" class="col-form-label ">@lang('messages.status'):</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>@lang('messages.Active')
                                </option>
                                <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>
                                    @lang('messages.Disactive')
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label for="name" class=" col-form-label text-md-left">@lang('messages.comment'):</label>
                            <textarea class="form-control" id="comment"
                                name="comment">{{ old('comment', $data->comment) }}</textarea>
                            <span class="text-danger">{{ $errors->first('comment') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit"
                                class="btn btn-success pull-right mat-btn ">@lang('messages.confirm')</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection
