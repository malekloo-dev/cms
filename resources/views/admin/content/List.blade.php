@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">
                @lang('messages.'.$type.'s')
            </li>
        </ul>

        @isset($company)
            <a class=" btn btn-warning btn-icon btn-sm  mat-button "
                href="{{ route('contents.type.show', ['type' => $type]) }}">
                <i class="fa fa-close"></i>{{ $company->name }}
            </a>
        @endisset

        <div>
            <a href="{{ route('contents.create', ['type' => $type]) }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i>@lang('messages.add')
            </a>

            <a href="{{ route('contents.create', ['type' => $type, 'template' => 'html']) }}"
                class=" btn btn-info btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add') @lang('messages.static template')
            </a>
        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang('messages.title')</th>
                            <th>@lang('messages.brief')</th>
                            <th>@lang('messages.category')</th>
                            <th class="text-center">@lang('messages.status')</th>
                            <th>@lang('messages.publish date')</th>
                            <th>@lang('messages.company')</th>
                            <th>@lang('messages.image')</th>
                            <th>@lang('messages.html')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($contents as $content)
                            <tr>
                                <td>{{ $content->id }}</td>
                                <td>{{ $content->title }}</td>
                                <td>{!! readMore($content->brief_description) !!}</td>
                                <td>


                                    @foreach ($content->categories as $it)
                                        @if ($it->id == $content->category->id)
                                            <i class="fa fa-check"></i>
                                        @endif
                                        {{ $it->title ?? '' }}
                                        <br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if ($content->status == 1)
                                        <i class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif
                                </td>

                                <td>
                                    {{ convertGToJ(date('Y-m-d', strtotime($content->publish_date))) }}

                                </td>
                                <td>
                                    @if ($content->companies->count())
                                        <a
                                            href="{{ route('contents.type.show', ['type' => $type, 'companyId' => $content->companies->first()->id]) }}">{{ $content->companies->first()->name }}</a>

                                    @endif

                                </td>
                                <td>
                                    @isset($content->images['images']['small'])
                                        <img height="30" src="{{ $content->images['images']['small'] }}" />
                                    @endisset
                                </td>
                                <td>
                                    @if (isset($content->attr['template_name']))
                                        <i class="fa fa-check"></i>
                                    @endif
                                </td>
                                <td class="width-100">
                                    <div class="row">
                                        <div class="col-xs-6">

                                            <a href="{{ route('contents.edit', ['content'=>$content->id,'page'=> json_decode($contents->toJson())->current_page]) }}"
                                                class="font-full-plus-half-em pull-left text-success btn-xs  no-border  "
                                                title="edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="col-xs-6 ">
                                            <form class=" width-30 height-30 line-height-30"
                                                action="{{ route('contents.destroy', $content->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em pull-left text-danger btn-xs  no-border no-bg "
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


                {!! $contents->appends(Request::except('page'))->onEachSide(5)->links() !!}
            </div>
        </div>
    </div>

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
