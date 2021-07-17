<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">

<head>
    <title>{{ $seo['meta_title'] ?? '' }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="{{ $seo['meta_keywords'] ?? '' }}">
    <meta name="description" content="{{ $seo['meta_description'] ?? '' }}">

    <link rel="manifest" href="{{ url(env('TEMPLATE_NAME').'/manifest.json') }}">
    <meta name="theme-color" content="#fff" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fa490e">
    <meta name="apple-mobile-web-app-title" content="corepo">
    <link rel="apple-touch-icon" href="{{ url(env('TEMPLATE_NAME').'/img/logo-96-96.png') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ url(env('TEMPLATE_NAME').'/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url(env('TEMPLATE_NAME').'/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url(env('TEMPLATE_NAME').'/img/logo-192-192.png') }}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{ url(env('TEMPLATE_NAME').'/img/logo-256-256.png') }}">
    <link rel="apple-touch-startup-image" href="{{ url(env('TEMPLATE_NAME').'/img/logo-512-512.png') }}">

    <meta name="msapplication-TileImage" content="{{ url(env('TEMPLATE_NAME').'/img/logo-192-192.png') }}">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-square100x100logo" content="{{ url(env('TEMPLATE_NAME').'/img/fav.png') }}">

    {{-- @yield('bootstrap') --}}

    <link rel="stylesheet" href="{{ mix('/'.env('TEMPLATE_NAME').'.css',env('TEMPLATE_NAME')) }}">
    <link rel="icon" href="{{ url(env('TEMPLATE_NAME').'/img/fav.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="{{ $seo['og:type'] ?? '' }}">
    <meta property="og:title" content="{{ $seo['meta_title'] ?? '' }}">
    <meta property="og:description" content="{{ $seo['meta_description'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['url'] ?? '' }}">
    <meta property="og:image" content="{{ url(env('TEMPLATE_NAME').'/img/logo2x.png') }}">

    <meta name="twitter:card" content="summary_large_image">

    @stack('head')

</head>

<body>
