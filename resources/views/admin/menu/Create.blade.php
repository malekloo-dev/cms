@extends('admin.layouts.app')
@section('content')
@section('ckeditor')

    <script>
        /*$(document).ready(function() { $("#parent_id").select2(); });

         $("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});

         $("#parent_id").select2("container").find("ul.select2-choices").sortable({
         containment: 'parent',
         start: function() { $("#parent_id").select2("onSortStart"); },
         update: function() { $("#parent_id").select2("onSortEnd"); }
         });*/

        $(document).ready(function () {

            var $parent = $(".parent");
            $parent.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });

            /*$("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});
             $("#parent_id").select2("container").find("ul.select2-choices").sortable({
             containment: 'parent',
             start: function() { $("#parent_id").select2("onSortStart"); },
             update: function() { $("#parent_id").select2("onSortEnd"); }
             });*/
        });
        var $module_id = $(".module_id");
        $module_id.select2();

        var $anchor_link = $(".anchor_link");
        $anchor_link.select2();


        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });

    </script>

@endsection


<div class="content-control">
    <ul class="breadcrumb">
        <li><a href="{{ route('menu.index') }}">@lang('messages.menu')</a></li>
        <li class="active">@lang('messages.add')</li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif


            <div class="form-group row">


                <div class="col-md-5">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                    <a class="btn btn-block" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        category
                                    </a>

                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <form action="{{ route('menu.store') }}" method="POST" name="add_content"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="panel-title">
                                                <label for="label" class="col-form-label">@lang('messages.menu') @lang('messages.name'):</label>
                                                <input type="text" class="form-control" name="label"
                                                       value="{{ old('label') }}"/>
                                                <span class="text-danger">{{ $errors->first('label') }}</span>

                                                <label for="parent" class="col-form-label text-md-left">@lang('messages.parent')</label>
                                                <select name="parent" id="parent"
                                                        class="parent" {{--class="form-control"--}}>
                                                    <option value="0">no parent</option>
                                                    @foreach ($menu as $Key => $fields)
                                                        <option value="{{ $fields['id'] }}">{!! $fields['symbol'] . $fields['label'] !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="module_id"
                                                       class="col-form-label text-md-left">@lang('messages.category')</label>
                                                <select name="module_id"
                                                        id="module_id" class="module_id" {{--class="form-control"--}}>
                                                    @foreach ($category as $Key => $fields)
                                                        <option value="{{ $fields['id'] }}">{!! $fields['title'] !!}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <label for="sort" class="col-form-label">sort:</label>
                                                <input type="text" class="form-control" name="sort"
                                                       value="{{ old('sort') }}"/>
                                                <span class="text-danger">{{ $errors->first('sort') }}</span>

                                            </div>

                                            <br/>

                                            <button type="submit"
                                                        class="btn btn-success @if(!$ltr) pull-right @endif mat-btn">@lang('messages.add')
                                                </button>

                                            </div>
                                        <input type="hidden" id="type" name="type" value="internal">
                                        <input type="hidden" id="type" name="module" value="category">

                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">

                                    <a  class="collapsed btn btn-block" role="button" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                       aria-controls="collapseTwo">
                                        external
                                    </a>

                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <form action="{{ route('menu.store') }}" method="POST" name="add_content"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="panel-title">
                                                <label for="label" class="col-form-label">@lang('messages.menu') @lang('messages.name'):</label>
                                                <input type="text" class="form-control" name="label"
                                                       value="{{ old('label') }}"/>
                                                <span class="text-danger">{{ $errors->first('label') }}</span>

                                                <label for="parent" class="col-form-label text-md-left">@lang('messages.parent')</label>
                                                <select name="parent" id="parent"
                                                        class="parent" {{--class="form-control"--}}>
                                                    <option value="0">no parent</option>
                                                    @foreach ($menu as $Key => $fields)
                                                        <option value="{{ $fields['id'] }}">{!! $fields['symbol'] . $fields['label'] !!}
                                                        </option>
                                                    @endforeach
                                                </select>


                                                <label for="link" class="col-form-label">@lang('messages.link'):</label>
                                                <input type="text" class="form-control" name="link"
                                                       value="{{ old('link') }}"/>
                                                <span class="text-danger">{{ $errors->first('link') }}</span>

                                                <label for="sort" class="col-form-label">sort:</label>
                                                <input type="text" class="form-control" name="sort"
                                                       value="{{ old('sort') }}"/>
                                                <span class="text-danger">{{ $errors->first('sort') }}</span>


                                            </div>

                                            <br/>

                                                <button type="submit"
                                                        class="btn btn-success @if(!$ltr) pull-right @endif mat-btn ">@lang('messages.add')
                                                </button>

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

                                    <a class="collapsed btn btn-block" role="button" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                       aria-controls="collapseThree">
                                        Single Page
                                    </a>

                            </div>

                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <form action="{{ route('menu.store') }}" method="POST" name="add_content"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="panel-title">
                                                    <label for="label" class="col-form-label">@lang('messages.menu') @lang('messages.name'):</label>
                                                    <input type="text" class="form-control" name="label"
                                                           value="{{ old('label') }}"/>
                                                    <span class="text-danger">{{ $errors->first('label') }}</span>

                                                    <label for="parent"
                                                           class="col-form-label text-md-left">parent</label>
                                                    <select name="parent" id="parent"
                                                            class="parent" >
                                                        <option value="0">no parent</option>
                                                        @foreach ($menu as $Key => $fields)
                                                            <option value="{{ $fields['id'] }}">{!! $fields['symbol'] . $fields['label'] !!}
                                                            </option>
                                                        @endforeach
                                                    </select>


                                                    <label for="anchor_link"
                                                           class="col-form-label text-md-left">link:</label>
                                                    <select name="link"
                                                            id="anchor_link"
                                                            class="anchor_link" >
                                                        @foreach ($single_page as $Key => $anchor)
                                                            <option value="{{ $anchor }}">{!! $anchor !!}#</option>
                                                        @endforeach

                                                    </select>


                                                    <label for="sort" class="col-form-label">sort:</label>
                                                    <input type="text" class="form-control" name="sort"
                                                           value="{{ old('sort') }}"/>
                                                    <span class="text-danger">{{ $errors->first('sort') }}</span>


                                                </div>

                                                <br/>
                                                    <button type="submit"
                                                            class="btn btn-success @if(!$ltr) pull-right @endif mat-btn ">@lang('messages.add')
                                                    </button>

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


<span class="text-danger">{{ $errors->first('brief_description') }}</span>
<span class="text-danger">{{ $errors->first('description') }}</span>
<span class="text-danger">{{ $errors->first('status') }}</span>
<span class="text-danger">{{ $errors->first('publish_date') }}</span>
