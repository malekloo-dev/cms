@extends('admin.layouts.app')

@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.category')</li>
        </ul>
        <div>
            <a href="{{ route('category.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add')
            </a>

        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width='50'></th>
                            <th>@lang('messages.title')</th>
                            <td width='100'></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contentType as $content)
                            <tr>
                                <td >{{ $content->id }}</td>
                                <td><a href="{{ route('admin.content.type.show',$content) }}">{!! $content->name !!} </a> </td>


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

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif--}}
