@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.Dashboard')</li>
        </ul>

    </div>

    <div class="content-body">
        <div class="dashboard">
            <div class="">
                <div class="title">@lang('messages.Products')</div>
                <div class="info">
                    <a class="count"
                        href="{{ route('contents.show', ['type' => 'product']) }}">{{ $data['productsCount'] }}</a>
                    <a href="{{ route('contents.create', ['type' => 'product']) }}"
                        class=" btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-plus"></i>افزودن
                    </a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.Articles')</div>
                <div class="info">
                    <a class="count"
                        href="{{ route('contents.show', ['type' => 'article']) }}">{{ $data['articlesCount'] }}</a>
                    <a href="{{ route('contents.create', ['type' => 'article']) }}"
                        class=" btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-plus"></i>افزودن
                    </a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.Comments')</div>
                <div class="info">
                    <a class="count" href="{{ route('comment.index') }}">{{ $data['commentsCount'] }}</a>
                </div>
            </div>

        </div>
    </div>
@endsection
