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
        <li class="active">@lang('messages.edit') {{ old('label)',$menu_info->label) }}</li>
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
                                 class="panel-collapse collapse {{ $menu_info->module == 'category' ? 'in' : '' }}"
                                 role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <form action="{{ route('menu.update', $menu_info->id) }}" method="POST"
                                          name="add_content"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="col-md-12">
                                            <div class="panel-title">
                                                <label for="label" class="col-form-label">نام منو:</label>
                                                <input type="text" class="form-control" name="label"
                                                       value="{{ old('label)',$menu_info->label) }}"/>
                                                <span class="text-danger">{{ $errors->first('label') }}</span>

                                                <label for="parent" class="col-form-label text-md-left">parent</label>

                                                <select name="parent" id="parent"
                                                        class="parent" {{--class="form-control"--}}>
                                                    <option value="0" {{ $menu_info->parent == 0 ? 'selected' : '' }}>no
                                                        parent
                                                    </option>
                                                    @foreach($menu as $Key => $fields)
                                                        <option value="{{$fields['id']}}" {{ $menu_info->parent == $fields['id'] ? 'selected' : '' }}>
                                                            {!! $fields['symbol'] . $fields['label'] !!}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div id="parent_id_val" class="parent_id_val"></div>


                                                <label for="module_id"
                                                       class="col-form-label text-md-left">category</label>
                                                <select name="module_id"
                                                        id="module_id" class="module_id" {{--class="form-control"--}}>
                                                    @foreach ($category as $Key => $fields)
                                                        <option value="{{ $fields['id'] }}">{!! $fields['title'] !!}
                                                        </option>
                                                    @endforeach

                                                </select>


                                                <label for="sort" class="col-form-label">sort:</label>
                                                <input type="text" class="form-control" name="sort"
                                                       value="{{ old('sort',$menu_info->sort) }}"/>
                                                <span class="text-danger">{{ $errors->first('sort') }}</span>

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

                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                       aria-controls="collapseTwo">
                                        external
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo"
                                 class="panel-collapse collapse {{ $menu_info->type == 'external' ? 'in' : '' }}"
                                 role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <form action="{{ route('menu.update', $menu_info->id) }}" method="POST"
                                          name="add_content"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col-md-12">
                                            <div class="panel-title">
                                                <label for="label" class="col-form-label">نام منو:</label>
                                                <input type="text" class="form-control" name="label"
                                                       value="{{ old('label)',$menu_info->label) }}"/>
                                                <span class="text-danger">{{ $errors->first('label') }}</span>

                                                <label for="parent" class="col-form-label text-md-left">parent</label>
                                                <select name="parent" id="parent"
                                                        class="parent" {{--class="form-control"--}}>
                                                    <option value="0" {{ $menu_info->parent == 0 ? 'selected' : '' }}>no
                                                        parent
                                                    </option>
                                                    @foreach($menu as $Key => $fields)
                                                        <option value="{{$fields['id']}}" {{ $menu_info->parent == $fields['id'] ? 'selected' : '' }}>
                                                            {!! $fields['symbol'] . $fields['label'] !!}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <div id="parent_id_val" class="parent_id_val"></div>

                                                <label for="link" class="col-form-label">link:</label>
                                                <input type="text" class="form-control" name="link"
                                                       value="{{ old('link',$menu_info->link) }}"/>
                                                <span class="text-danger">{{ $errors->first('link') }}</span>

                                                <label for="sort" class="col-form-label">sort:</label>
                                                <input type="text" class="form-control" name="sort"
                                                       value="{{ old('sort',$menu_info->sort) }}"/>
                                                <span class="text-danger">{{ $errors->first('sort') }}</span>


                                            </div>

                                            <br/>
                                            <div class="col-md-12">
                                                <button type="submit"
                                                        class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">@lang('messages.add')
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="type" name="type" value="external">
                                        <input type="hidden" id="type" name="module" value="">

                                    </form>
                                </div>

                            </div>
                        </div>
                        @if (count($single_page))
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            Single Page
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseThree"
                                     class="panel-collapse collapse {{ $menu_info->type == 'single_page' ? 'in' : '' }}"
                                     role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <form action="{{ route('menu.update', $menu_info->id) }}" method="POST"
                                              name="add_content"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="col-md-12">
                                                <div class="panel-title">
                                                    <label for="label" class="col-form-label">نام منو:</label>
                                                    <input type="text" class="form-control" name="label"
                                                           value="{{ old('label)',$menu_info->label) }}"/>
                                                    <span class="text-danger">{{ $errors->first('label') }}</span>

                                                    <label for="parent"
                                                           class="col-form-label text-md-left">parent</label>

                                                    <select name="parent" id="parent"
                                                            class="parent" {{--class="form-control"--}}>
                                                        <option value="0" {{ $menu_info->parent == 0 ? 'selected' : '' }}>
                                                            no parent
                                                        </option>
                                                        @foreach($menu as $Key => $fields)
                                                            <option value="{{$fields['id']}}" {{ $menu_info->parent == $fields['id'] ? 'selected' : '' }}>
                                                                {!! $fields['symbol'] . $fields['label'] !!}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div id="parent_id_val" class="parent_id_val"></div>


                                                    <label for="anchor_link"
                                                           class="col-form-label text-md-left">link:</label>
                                                    <select name="link"
                                                            id="anchor_link"
                                                            class="anchor_link" {{--class="form-control"--}}>
                                                        @foreach ($single_page as $Key => $anchor)
                                                            <option value="{{ $anchor }}"{{ $menu_info->link == $anchor ? 'selected' : '' }}>
                                                                {!! $anchor !!}#
                                                            </option>
                                                        @endforeach

                                                    </select>


                                                    <label for="sort" class="col-form-label">sort:</label>
                                                    <input type="text" class="form-control" name="sort"
                                                           value="{{ old('sort',$menu_info->sort) }}"/>
                                                    <span class="text-danger">{{ $errors->first('sort') }}</span>

                                                </div>

                                                <br/>
                                                <div class="col-md-12">
                                                    <button type="submit"
                                                            class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">@lang('messages.add')
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" id="type" name="type" value="single_page">
                                            <input type="hidden" id="type" name="module" value="">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endif

                    </div>


                </div>

            </div>


        </div>
    </div>
</div>

@endsection
