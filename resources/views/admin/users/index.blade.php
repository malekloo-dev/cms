@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.users')</li>
        </ul>

        <div>
            <a href="{{ route('users.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add') @lang('messages.user')
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
                            <td>ID</td>
                            <td>@lang('messages.mobile')</td>
                            <td>@lang('messages.password')</td>
                            <td>@lang('messages.name')</td>
                            <td>@lang('messages.email')</td>
                            <td>@lang('messages.company')</td>
                            <td>@lang('messages.register date')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->mobile }} </td>
                                <td>{{ $user->pass }} </td>
                                <td>{{ ($user->name == '') ? $user->customer?->name : $user->name }}
                                    <br>
                                    {{ $user->customer?->address }}
                                    {{ $user->customer?->zipcode }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->company?->name }}</td>
                                <td class="ltr text-right">{{ $user->date }}</td>
                                <td class="width-80">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <form class=" width-30 height-30 line-height-30"
                                                action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg "
                                                    onclick="return confirm('@lang('messages.Are you sure?')')"
                                                    type="submit"
                                                    title="@lang('messages.delete')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg "
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
