<!DOCTYPE html>
<html lang="fa">
<head>
    <title>{{$seo['title'] ?? "" }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo['meta_keywords'] ?? "" }}">
    <meta name="description" content="{{$seo['meta_description']  ?? ""}}">

    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/style.css') }}">
    <link rel="icon" href="{{ asset(@env('TEMPLATE_NAME').'img/logo1.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    @yield('assets')
</head>
<body>
