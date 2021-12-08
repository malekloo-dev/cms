@extends('admin.layouts.app')

@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.content.type.index') }}">@lang('messages.attribute')</a></li>
            <li class="active">{{ $contentType->name }}</li>
        </ul>
       
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
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
                                <td>{{ $content->label }}</td>
                                <td>{{ $content->element_type }}</td>
                                <td>{{ $content->element_input_type }}</td>
                                <td>{{ $content->required }}</td>
                                <td>{{ $content->filter }}</td>

                                <td class="">
                                    <div class="">

                                        <form class=" line-height-30"
                                            action="{{ route('admin.content.type.delete.attribute', ['attribute' => $content->id, 'contentType' => $contentType]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                type="submit" title="@lang('messages.delete')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="">

                                        {{-- <a href="{{ route('category.edit', $content->id) }}"
                                            class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30"
                                            title="@lang('messages.edit')">
                                            <i class="fa fa-edit"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
