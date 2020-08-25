@extends('admin.layouts.app')
@section('content')
<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">Redirect Url</a></li>
    </ul>

    <a href="{{ route('seo.redirectUrl.create') }}" class="top-heading-button btn btn-success btn-icon mat-elevation-z radius-all mat-button ">
        <i class="fa fa-plus"></i> افزودن
    </a>


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
                        <th>Url</th>
                        <th>Redirect to </th>
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($RedirectUrl as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{!! $item->url !!}</td>
                        <td>{!! $item->redirect_to !!}</td>


                        <td>

                            <form class="pull-right" action="{{ route('seo.redirectUrl.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('آیا مطمئن هستید؟')" class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                            <a href="{{ route('seo.redirectUrl.edit',$item->id)}}" class="font-full-plus-half-em text-success btn-xs pull-right" title="edit">
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
