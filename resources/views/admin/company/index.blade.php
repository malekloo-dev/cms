@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.companies')</li>
        </ul>
        <div>
            <a href="{{ route('admin.company.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i>@lang('messages.add')
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
                            <th>@lang('messages.name')</th>
                            <th>@lang('messages.email')</th>
                            <th>@lang('messages.mobile')</th>
                            <th>@lang('messages.logo')</th>
                            <th>@lang('messages.category')</th>
                            <th>@lang('messages.status')</th>

                            <th>@lang('messages.updated at')</th>
                            <th>@lang('messages.created at')</th>
                            <th width="50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="">
                                    <a href="{{ route('profile.index', $item->id) }}" target="__blank"> <i
                                            class="fa fa-external-link"></i></a>
                                    {{ $item->name ?? '' }}
                                    <br>
                                    <a
                                        href="{{ route('contents.type.show', ['type' => 'product', 'companyId' => $item->id]) }}">@lang('messages.products') ({{ $item->contents()->where('type','=',2)->count() }})</a>

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
                                            {{ $item->viewCount }}
                                        </div>
                                    </td>
                                <td class="">{{ $item->email ?? '' }}</td>
                                <td class="">{{ $item->mobile ?? '' }}</td>
                                <td class=""><img src="{{ $item->logo['small'] ?? '' }}" alt=""></td>
                                <td>

                                    @foreach ($item->categories as $it)
                                        @if ($it->id == $item->category?->id)
                                            <i class="fa fa-check"></i>
                                        @endif
                                        {{ $it->title ?? '' }}
                                        <br>
                                    @endforeach

                                </td>

                                <td>{!! ($item->status==1)?'<i class="fa fa-check"></i>':'' !!}</td>

                                <td class="">{{ convertGToJ($item->updated_at,$time=true) }}

                                </td>
                                <td class="">{{ convertGToJ($item->created_at,true) }} </td>

                                <td>
                                    <div class="">
                                        <div class="">
                                            <form class="pull-right"
                                                action="{{ route('admin.company.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                        <div class="">
                                            <a href="{{ route('admin.company.update', $item->id) }}"
                                                class="font-full-plus-half-em text-success btn-xs pull-right"
                                                title="@lang('messages.edit')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
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
