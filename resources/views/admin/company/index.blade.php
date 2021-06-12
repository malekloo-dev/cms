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

                            <th>@lang('messages.updated at')</th>
                            <th>@lang('messages.created at')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="">{{ $item->name ?? '' }} <a href="{{ route('contents.type.show',['type'=>'product','company'=>'company','companyId'=>$item->id]) }}">@lang('messages.products')</a></td>
                                <td class="">{{ $item->email ?? '' }}</td>
                                <td class="">{{ $item->mobile ?? '' }}</td>
                                <td class=""><img src="{{ $item->logo['small'] ?? '' }}" alt=""></td>

                                <td class="">{{ convertGToJ($item->updated_at) }}</td>
                                <td class="">{{ convertGToJ($item->created_at) }}</td>

                                <td class="width-100">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="pull-right" action="{{ route('comment.destroy', $item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                    type="submit" title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('comment.edit', $item->id) }}"
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
