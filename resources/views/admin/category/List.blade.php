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
            <a href="{{ route('category.create', ['template' => 'html']) }}" class=" btn btn-info btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add') @lang('messages.static template')
            </a>
        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang('messages.title')</th>
                            <th>@lang('messages.brief')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.image')</th>
                            <th>@lang('messages.html')</th>
                            <th>@lang('messages.content')</th>
                            <th>@lang('messages.products')</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $content)
                            <tr>
                                <td>{{ $content->id }}</td>
                                <td><a href="{{ url($content->slug) }}" target="__blank">{!! $content->symbol . $content->title !!} <i class="fa fa-external-link"></i></a>
                                    <div>
                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                fill="currentColor" />
                                        </svg>
                                        {{ number_format($content->viewCount,0) }}
                                    </div>
                                </td>
                                <td>{!! readMore($content->brief_description) !!}</td>
                                <td>
                                    @if ($content->status == 1)
                                        <i class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif
                                </td>
                                <td>
                                    @isset($content->images['images']['small'])
                                        <img height="30" src="{{ $content->images['images']['small'] }}" />
                                    @endisset
                                </td>
                                <td>
                                    @if (isset($content->attr['template_name']))
                                        <i title="{{ $content->attr['template_name'] }}" class="fa fa-check"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ count($content->posts) }}
                                </td>

                                <td>
                                    {{ count($content->products) }}
                                </td>

                                <td class="width-100">
                                    <div class="col-md-6">

                                        <form class=" line-height-30" action="{{ route('category.destroy', $content->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                type="submit"
                                                title="@lang('messages.delete')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">

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
