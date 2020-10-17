@extends('admin.layouts.app')
@section('content')
<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">مقالات </a></li>
    </ul>


    @if( $type === 'article')
    <a href="{{ route('contents.create',['type'=>'article'])}}" class="top-heading-button btn btn-success btn-icon mat-elevation-z radius-all mat-button ">
        <i class="fa fa-plus"></i>افزودن
    </a>
    @elseif( $type === 'product')
    <a href="{{ route('contents.create',['type'=>'product'])}}" class="top-heading-button btn btn-success btn-icon mat-elevation-z radius-all mat-button ">
        <i class="fa fa-plus"></i>افزودن
    </a>
    @endif
    <a href="{{ route('contents.create',['type'=>'html'])}}" class="top-heading-button btn btn-warning btn-icon mat-elevation-z radius-all mat-button ">
        <i class="fa fa-plus"></i> افزودن قالب استاتیک
    </a>
</div>

<div class="content-body">
    <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
        <div class="panel-body full-height">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>عنوان</th>
                        <th>مختصر</th>
                        <th>دسته بندی</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>


                    @foreach($contents as $content)
                    <tr>
                        <td>{{ $content->id }}</td>
                        <td>{{ $content->title }}</td>
                        <td>{{ readMore($content->brief_description) }}</td>
                        <td>
                            @if (isset($content->parent_id) && isset($category[$content->parent_id]))
                            {{ $category[$content->parent_id]->title }}
                            @endif
                        </td>
                        <td>
                            @if ($content->status == 1)
                            {{'فعال'}}
                            @else
                            {{'غیر فعال'}}
                            @endif
                            {{--{{ $content->status ? 'فعال' : 'غیر فعال' }}--}}</td>

                        <td>{{ date('Y-m-d', strtotime($content->publish_date)) }}</td>
                        <td>
                            <form class=" width-30 height-30 line-height-30" action="{{ route('contents.destroy', $content->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('آیا مطمئن هستید؟')" class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg no-padding" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('contents.edit',$content->id)}}" class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30" title="edit">
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




{{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
</div>
@endif--}}
