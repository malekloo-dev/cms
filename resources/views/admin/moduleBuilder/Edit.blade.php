@extends('admin.layouts.app')
@section('content')
@section('ckeditor')

    <script>

        $(document).ready(function () {

            var $parent = $(".parent");
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
            <div class="form-group row">


                <div class="col-md-5">

                    @foreach($arrayContent as $Key => $attr)

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            category
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseOne"
                                     class="panel-collapse collapse {{--{{ $menu_info->module == 'category' ? 'in' : '' }}--}}"
                                     role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="panel-body">


                                        <div class="col-md-12">
                                            <div class="panel-title">

                                                <label for="parent" class="col-form-label text-md-left">انتخاب از یک دسته خاص</label>

                                                <select name="parent" id="parent"
                                                        class="parent" {{--class="form-control"--}}>
                                                    <option value="0">نمایش از همه دسته ها</option>
                                                    @foreach($category as $Key => $fields)
                                                        <option value="{{$fields['id']}}" >
                                                            {!! $fields['title'] !!}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div id="parent_id_val" class="parent_id_val"></div>


                                            </div>

                                            <br/>
                                            <div class="col-md-12">
                                                <button type="submit"
                                                        class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">@lang('messages.add')
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="type" name="type" value="internal">
                                        <input type="hidden" id="type" name="module" value="category">

                                    </div>

                                </div>
                            </div>
                            {{--//------------------------}}

                        </div>

                    @endforeach
                </div>

            </div>


        </div>
    </div>
</div>

@endsection
