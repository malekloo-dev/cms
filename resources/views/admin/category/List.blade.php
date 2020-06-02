
@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a class="text-18">Category</a></li>
        </ul>

        <a href="{{ route('category.create') }}"
           class="top-heading-button btn btn-warning btn-icon mat-elevation-z radius-all mat-button pos-abs">
            <i class="fa fa-plus"></i> Create New Category
        </a>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Brief Description</th>
                        <th>Status</th>
                        <td colspan="2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contents as $content)
                        <tr>
                            <td>{{ $content->id }}</td>
                            <td>{!!$content->symbol. $content->title  !!}</td>
                            <td>{!! $content->brief_description !!}</td>
                            <td>
                                @if ($content->status == 1)
                                    {{'فعال'}}
                                @else
                                    {{'غیر فعال'}}
                                @endif
                                {{--{{ $content->status ? 'فعال' : 'غیر فعال' }}--}}</td>

                            <td class="width-80">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <form class=" width-30 height-30 line-height-30" action="{{ route('category.destroy', $content->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg no-padding" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="{{ route('category.edit',$content->id)}}"
                                           class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30" title="edit">
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




   {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif--}}
