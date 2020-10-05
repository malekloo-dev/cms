<!DOCTYPE html>
<html lang="fa">

<head>
    <title>{{$seo['meta_title'] ?? "" }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo['meta_keywords'] ?? "" }}">
    <meta name="description" content="{{$seo['meta_description']  ?? ""}}">

    <link rel="stylesheet" href="{{ asset('/style.css') }}">
    <link rel="icon" href="{{ asset('/img/fav.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="{{$seo['og:type'] ?? "" }}">
    <meta property="og:title" content="{{$seo['meta_title'] ?? "" }}">
    <meta property="og:description" content="{{$seo['meta_description']  ?? ""}}">
    <meta property="og:url" content="{{ $seo['url'] ?? ""}}">
    <meta property="og:image" content="{{ asset('/img/logo2x.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <!-- <meta property="og:image:width" content="405">
    <meta property="og:image:height" content="300"> -->

    @yield('assets')
</head>

<body>
