@extends('admin.layouts.app')
@section('content')
<div class="content-control">
    <ul class="breadcrumb">
        <li class="active">کامنت ها</li>
    </ul>


</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
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
                        <th>نام</th>
                        <th>کامنت</th>
                        <th>وضعیت</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td class="">{{ $item->name ?? '' }}</td>
                        <td class="">{!! $item->comment !!}</td>
                        <td class="">{{ $item->status }}</td>
                        <td class="">{{ $item->created_at }}</td>

                        <td>

                            <form class="pull-right" action="{{ route('comment.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('آیا مطمئن هستید؟')" class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                            <a href="{{ route('comment.edit',$item->id)}}" class="font-full-plus-half-em text-success btn-xs pull-right" title="edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
