@extends('admin.layouts.app')
@section('content')
<div class="content-control">
    <ul class="breadcrumb">
        <li><a class="text-18">دسته بندی</a></li>
    </ul>

    <a href="{{ route('category.create') }}" class="top-heading-button btn btn-success btn-icon  mat-button ">
        <i class="fa fa-plus"></i> افزودن
    </a>
    <a href="{{ route('category.create',['type'=>'html'])}}" class="top-heading-button btn btn-info btn-icon  mat-button ">
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
                        <th>توضیحات مختصر</th>
                        <th>وضعیت</th>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contents as $content)
                    <tr>
                        <td>{{ $content->id }}</td>
                        <td>{!!$content->symbol. $content->title !!}</td>
                        <td>{!! readMore($content->brief_description) !!}</td>
                        <td>
                            @if ($content->status == 1)
                            {{'فعال'}}
                            @else
                            {{'غیر فعال'}}
                            @endif
                            {{--{{ $content->status ? 'فعال' : 'غیر فعال' }}--}}</td>

                        <td>

                            <form class=" width-30 height-30 line-height-30" action="{{ route('category.destroy', $content->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('آیا مطمئن هستید؟')" class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg no-padding" type="submit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$content->id)}}" class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30" title="edit">
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
