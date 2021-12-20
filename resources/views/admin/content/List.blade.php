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

        <form  style="margin-bottom:1em; display:inline-flex;flex-wrap:wrap " action="{{ route('contents.type.show', ['type' => $type]) }}" method="get">

            <div>

                <label for="qtitle"> @lang('messages.title')</label>
                <input id="qtitle" name="qtitle" value="{{ old('qtitle', app('request')->qtitle) }}" type="text">
            </div>

            <div>

                <label for="qslug"> @lang('messages.url')</label>
                <input id="qslug" name="qslug" dir="ltr" value="{{ old('qslug', app('request')->qslug) }}" type="text">
            </div>
            <button>فیلتر</button>
        </form>

        <div>
            <a href="#" class=" btn btn-success btn-icon  mat-button " data-toggle="modal" data-target="#chooseAttribute">
                <i class="fa fa-plus"></i>@lang('messages.add')
            </a>

            <a href="{{ route('contents.create', ['type' => $type, 'template' => 'html']) }}"
                class=" btn btn-info btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add') @lang('messages.static template')
            </a>


            <!-- Modal -->
            <div class="modal fade" id="chooseAttribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">برای ساخت محصول یکی از ویژگی های زیر را انتخاب
                                نمایید</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('contents.create', ['type' => $type]) }}">
                                <select class="form-control" name="attr" id="">
                                    <option value="">بدون ویژگی</option>
                                    @foreach ($attributes as $item)

                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                                <br>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                <button type="submit" class="btn btn-primary">انتقال به فرم افزودن </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body "style="overflow: auto; ">
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
                <table class="table table-striped " >
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
                                <td>{{ $content->title }}
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
                                        {{ $content->viewCount }}
                                    </div></td>
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
                                        <div style="display:flex">

                                            <a href="{{ route('contents.edit', ['content' => $content->id, 'page' => json_decode($contents->toJson())->current_page, 'qtitle' => app('request')->qtitle, 'qslug' => app('request')->qslug]) }}"
                                                class="font-full-plus-half-em text-success btn-xs  no-border  "
                                                title="edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="{{ url($content->slug) }}"
                                                class="font-full-plus-half-em  text-black btn-xs  no-border  " title="view"
                                                target="__blank">
                                                <i class="fa fa-eye"></i>
                                            </a>

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


                {!! $contents->appends(Request::except('page'))->appends(Request::except('qtitle'))->onEachSide(5)->links() !!}
            </div>
        </div>
    </div>

@endsection




{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
