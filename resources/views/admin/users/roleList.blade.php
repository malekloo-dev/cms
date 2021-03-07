@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.roles')</li>
        </ul>
        <div>
            <a href="{{ route('role.create') }}" class="btn btn-success btn-icon mat-button ">
                <i class="fa fa-plus"></i> @lang('messages.add')
            </a>
        </div>

    </div>

    <div class="content-body">
        <div class="panel panel-default  pos-abs chat-panel bottom-0">
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

                @foreach ($roles as $item)
                    <div class="col-2 col-lg-2 col-md-2 col-sm-3 role">
                        <div for="">{{ $item->name }}</div>




                        <div class="items">
                            <div>

                                <a href="{{ route('role.permissions.index', $item->id) }}"
                                    title="@lang('messages.permissions')"> <i
                                        class="fa fa-lock    font-full-plus-half-em"></i>
                                </a>
                                <a href="{{ route('role.users.index', $item->id) }}" title="@lang('messages.users')"> <i
                                        class="fa fa-users    font-full-plus-half-em"></i> </a>
                            </div>

                            <div class="tools">
                                <form action="{{ route('role.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                        class="font-full-plus-half-em text-danger no-border " type="submit"
                                        title="@lang('messages.delete')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('role.edit', $item->id) }}" class="font-full-plus-half-em text-success "
                                    title="@lang('messages.edit')">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <style>
        .p-1 {
            padding: .5em;
            font-size: 1.2em
        }

        .fa-lock {
            color: orange
        }

        .role {
            padding: 1em;
            margin: 1em;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            background-color: #f4f4f4
        }
        .role > :first-child{font-weight: bold}

        .items {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .items > div > a {
            padding: .5em
        }

        .items .tools {
            background-color: rgba(0, 0, 0, .1);
            display: flex;
            padding: .5em;
            border-radius: 4px;
            align-items: center;
        }

        .items .tools>* {
            margin: 0 4px;
            background-color: none !important;
            padding: .1em;
        }

        .items .tools button {
            background-color: transparent !important;
        }

    </style>

@endsection
