@extends('admin.layouts.app')

@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.attribute')</li>
        </ul>

    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">

                {{--  --}}
                {{-- content type --}}
                {{--  --}}
                <div>
                    <a href="#" data-toggle="modal" data-target="#addContentType"
                        class="pull-left btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-plus"></i> @lang('messages.add') گروه
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="addContentType" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">افزودن گروه</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="modal-form" action="{{ route('admin.content.type.store') }}" method="post">
                                        @csrf
                                        <div>
                                            <label for="">عنوان</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                    <button type="submit" form="modal-form" class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width='50'></th>
                            <th>گروه</th>
                            <th>تعداد ویژگی ها</th>
                            <th>اضافه شدن گروه به محتوا یا دسته</th>
                            <th width='100'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contentType as $content)
                            <tr>
                                <td>{{ $content->id }}</td>
                                <td><a href="{{ route('admin.content.type.show', $content) }}">{!! $content->name !!}
                                    </a>
                                </td>
                                {{--  --}}
                                {{-- add attribute --}}
                                {{--  --}}
                                <td>{{ $content->attributes->count() }}
                                    <a href="" class="btn btn-success mat-button" data-toggle="modal"
                                        data-target="#addAttribute{{ $content->id }}"
                                        style="margin-right: 1em; border-radius:50px"> <i class="fa fa-plus"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addAttribute{{ $content->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">افزودن گروه</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="addAttribute-form{{ $content->id }}"
                                                        action="{{ route('admin.content.type.add.attribute', $content) }}"
                                                        method="post">
                                                        @csrf
                                                        <div>
                                                            <label for="">عنوان</label>
                                                            <select name="attribute_type_id" class="form-control" id="">
                                                                @foreach ($attributes as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">انصراف</button>
                                                    <button type="submit" form="addAttribute-form{{ $content->id }}"
                                                        class="btn btn-primary">ذخیره</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td>

                                    {{--  --}}
                                    {{-- add content --}}
                                    {{--  --}}
                                    <a href="" class="btn btn-success mat-button" data-toggle="modal"
                                        data-target="#addContentTypeToContents{{ $content->id }}"
                                        style="margin-right: 1em; border-radius:50px"> <i class="fa fa-plus"></i></a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="addContentTypeToContents{{ $content->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">افزودن گروه</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="addContentTypeToContents-form{{ $content->id }}"
                                                        action="{{ route('admin.content.type.add.contents', $content) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">عنوان</label>

                                                            <select name="attribute_type_id" class="" id=""
                                                                multiple="multiple">
                                                                @foreach ($contents as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">انصراف</button>
                                                    <button type="submit"
                                                        form="addContentTypeToContents-form{{ $content->id }}"
                                                        class="btn btn-primary">ذخیره</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="">
                                    <div class="">

                                        @if ($content->attributes->count() == 0)


                                            <form class=" line-height-30"
                                                action="{{ route('admin.content.type.destroy', $content) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="">

                                        <a href="" data-toggle="modal" data-target="#edit{{ $content->id }}"
                                            class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30"
                                            title="@lang('messages.edit')">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edit{{ $content->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ویرایش ویژگی
                                                            {{ $content->name }}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="modal-form"
                                                            action="{{ route('admin.content.type.update', $content) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="contentTypeId"
                                                                value="{{ $content->id }}">
                                                            <div>
                                                                <label for="">عنوان</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $content->name }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">انصراف</button>
                                                        <button type="submit" form="modal-form"
                                                            class="btn btn-primary">ذخیره</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>




                {{--  --}}
                {{-- attributs --}}
                {{--  --}}
                <hr>
                <br>

                <div>
                    <a href="#" data-toggle="modal" data-target="#addattribute"
                        class=" btn btn-success pull-left btn-icon  mat-button ">
                        <i class="fa fa-plus"></i> @lang('messages.add') ویژگی
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="addattribute" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">افزودن ویژگی</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="modal-form-attribute" action="{{ route('admin.attribute.store') }}"
                                        method="post">
                                        @csrf
                                        <div>
                                            <label for="">ویژگی</label>
                                            <input type="text" class="form-control" name="label">
                                        </div>
                                        <div>
                                            <label for="">field_name</label>
                                            <input type="text" class="form-control" name="field_name">
                                        </div>
                                        <div>
                                            <label for="">element_type</label>
                                            <select name="element_type" class="form-control" id="">
                                                <option value="text">text</option>
                                                <option value="text">combo</option>
                                                <option value="textArea">textArea</option>
                                            </select>

                                        </div>
                                        <div>
                                            <label for="">element_input_type</label>
                                            <select name="element_type" class="form-control" id="">
                                                <option value="text">text</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="">required</label>
                                            <select name="required" class="form-control" id="">
                                                <option value="0">not required</option>
                                                <option value="1">required</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="">filter</label>
                                            <select name="filter" class="form-control" id="">
                                                <option value="0">not filter</option>
                                                <option value="1">filter</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                    <button type="submit" form="modal-form-attribute" class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width='50'>id</th>
                            <th>field_name</th>
                            <th>ویژگی</th>
                            <th>element_type</th>
                            <th>element_input_type</th>
                            <th>required</th>
                            <th>filter</th>
                            <th width='100'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $content)
                            <tr>
                                <td>{{ $content->id }}</td>
                                <td>{{ $content->field_name }}</td>
                                <td>{!! $content->label !!}</td>
                                <td>{{ $content->element_type }}</td>
                                <td>{{ $content->element_input_type }}</td>
                                <td>{{ $content->required }}</td>
                                <td>{{ $content->filter }}</td>

                                <td class="">
                                    <div class="">

                                        {{-- <form class=" line-height-30" action="{{ route('category.destroy', $content->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                type="submit"
                                                title="@lang('messages.delete')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                    <div class="">

                                        <a href="{{ route('category.edit', $content->id) }}"
                                            class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30"
                                            title="@lang('messages.edit')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var $input = $("select");
            $input.select2();
        });
    </script>

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
