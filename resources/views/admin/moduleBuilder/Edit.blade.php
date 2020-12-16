@extends('admin.layouts.app')
@section('content')
@section('ckeditor')

    <script>

        $(document).ready(function () {

            var $parent = $(".parent_id");
            $parent.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });

        });
        var $module_id = $(".module_id");
        $module_id.select2();

        var $anchor_link = $(".anchor_link");
        $anchor_link.select2();

    </script>

@endsection



<div class="content-control">
    <ul class="breadcrumb">
        <li><a href="{{ route('menu.index')}}">@lang('messages.category')</a></li>
        <li class="active">@lang('messages.edit') </li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <form method="post" action="{{ route('moduleBuilder.update', 1) }}" class="center-block form-max-width"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row">


                    <div class="col-md-12">

                        @foreach($arrayContent as $Key => $attr)
                            <?php
                            //dd($widgets);

                            $widget['parent_id'] = 0;
                            $widget['sort'] = '';

                            if (is_array($widgets->attr) and isset($widgets->attr[$attr['config']['var']])) {
                                $widget = $widgets->attr[$attr['config']['var']];
                            }

                            ?>

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{$attr['config']['var']}}">
                                        <h4 class="panel-title">
                                            <a role="button"  data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse{{$attr['config']['var']}}" aria-expanded="true"
                                               aria-controls="collapse{{$attr['config']['var']}}">
                                                {{$attr['config']['label']}}
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapse{{$attr['config']['var']}}"
                                         class="panel-collapse collapse {{--{{ $menu_info->module == 'category' ? 'in' : '' }}--}}"
                                         role="tabpanel"
                                         aria-labelledby="heading{{$attr['config']['var']}}">
                                        <div class="panel-body">


                                            {{--
                                            <div class="form-group row">--}}
                                            {{--
                                            <div class="col-md-12">--}}
                                            {{--<label for="price" class=" col-form-label text-md-left">@lang('messages.price'):</label>--}}
                                            {{--<input type="text" class="form-control"
                                                       name="attr[$attr][price]"
                                                       --}}
                                            {{--value="{{ old('attr[price]', $content_info->attr['price']) }}"/>--}}
                                            {{--
                                        </div>
                                        --}}
                                            {{--
                                        </div>
                                        --}}

                                            <div class="col-md-12">
                                                <div class="panel-title">

                                                    <label for="parent" class="col-form-label text-md-left">select
                                                        category
                                                        to show widget {{$attr['config']['label']}}</label>

                                                    <select name="attr[{{$attr['config']['var']}}][parent_id]"
                                                            id="parent_id"
                                                            class="parent_id" {{--class="form-control" --}}>
                                                        <option value="0">show {{$attr['type']}} from all categories
                                                        </option>
                                                        @foreach($category as $Key => $fields)
                                                            <option value="{{$fields['id']}}" {{  $widget['parent_id'] == $fields['id'] ? 'selected' : '' }}>
                                                                {!! $fields['title']!!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <br/>
                                                <div class="col-md-12">
                                                    <label for="sort"
                                                           class="col-form-label text-md-left">Sorting</label>

                                                    <select name="attr[{{$attr['config']['var']}}][sort]" id="sort"
                                                            class="parent_id" {{--class="form-control" --}}>
                                                        <option value="publish_date desc" {{  $widget['sort'] == 'publish_date desc' ? 'selected' : '' }}>
                                                            date desc
                                                        </option>
                                                        <option value="publish_date asc" {{  $widget['sort'] == 'publish_date asc' ? 'selected' : '' }}>
                                                            date asc
                                                        </option>
                                                        <option value="viewCount asc" {{  $widget['sort'] == 'viewCount asc' ? 'selected' : '' }}>
                                                            view Count asc
                                                        </option>
                                                        <option value="viewCount desc" {{  $widget['sort'] == 'viewCount desc' ? 'selected' : '' }}>
                                                            view Count desc
                                                        </option>
                                                        <option value="commentCount asc" {{  $widget['sort'] == 'commentCount asc' ? 'selected' : '' }}>
                                                            comment Count asc
                                                        </option>
                                                        <option value="commentCount desc" {{  $widget['sort'] == 'commentCount desc' ? 'selected' : '' }}>
                                                            comment Count desc
                                                        </option>

                                                    </select>
                                                    <div id="parent_id_val" class="parent_id_val"></div>

                                                    {{--@if ($attr['config']['type']=='post')--}}
                                                    {{--@php --}}
                                                    {{--$helpLabel=''--}}
                                                    {{--$i = 1--}}
                                                    {{--@endphp--}}
                                                    {{--@endif--}}
                                                    {{--@php--}}
                                                    {{--$i = 1--}}
                                                    {{--@endphp--}}

                                                </div>
                                                <br/>
                                                <br/>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                                {{--//------------------------}}

                            </div>
                            <input type="hidden" id="type" name="attr[{{$attr['config']['var']}}][type]"
                                   value="{{$attr['type']}}">
                            <input type="hidden" id="count" name="attr[{{$attr['config']['var']}}][count]"
                                   value="{{$attr['config']['count'] ?? '1' }}">
                        @endforeach
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-success btn-block mat-btn ">
                                @lang('messages.edit')
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
