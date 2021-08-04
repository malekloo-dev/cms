<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">

<head>
    <title>{{ $seo['meta_title'] ?? ''}}@yield('meta-title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $seo['meta_keywords'] ?? '' }}">
    <meta name="description" content="{{ $seo['meta_description'] ?? '' }}">

    <link rel="manifest" href="{{ url(env('TEMPLATE_NAME') . '/manifest.json') }}">
    <meta name="theme-color" content="#fa490e" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fa490e">
    <meta name="apple-mobile-web-app-title" content="درب کالا">
    <link rel="apple-touch-icon" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-96-96.png') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-192-192.png') }}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-256-256.png') }}">
    <link rel="apple-touch-startup-image" href="{{ url(env('TEMPLATE_NAME') . '/img/logo-512-512.png') }}">

    <meta name="msapplication-TileImage" content="{{ url(env('TEMPLATE_NAME') . '/img/logo-192-192.png') }}">
    <meta name="msapplication-TileColor" content="#fa490e">
    <meta name="msapplication-square96x96logo" content="{{ url(env('TEMPLATE_NAME') . '/img/logo-96-96.png') }}">
    <meta name="msapplication-square152x152logo" content="{{ url(env('TEMPLATE_NAME') . '/img/logo-152-152.png') }}">



    @yield('bootstrap')

    <link rel="stylesheet" href="{{ mix('/'.env('TEMPLATE_NAME').'.css',env('TEMPLATE_NAME')) }}" >
    <link rel="icon" href="{{ url(env('TEMPLATE_NAME') . '/img/fav.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="{{ $seo['og:type'] ?? '' }}">
    <meta property="og:title" content="{{ $seo['meta_title'] ?? '' }}">
    <meta property="og:description" content="{{ $seo['meta_description'] ?? '' }}">
    <meta property="og:url" content="{{ Request::url() ?? $seo['url'] }}">


    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@DarbkalaC">
    <meta name="twitter:title" content="{{$seo['meta_title'] ?? "" }}" />
    <meta name="twitter:description" content="{{$seo['meta_description']  ?? ""}}" />
    <meta name="twitter:creator" content="@DarbkalaC">
    <meta name="twitter:domain" content="https://darbkala.com/">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('/img/logo2x.png') }}">



    {{-- <script src="https://www.p30rank.ir/google" async></script> --}}
    @yield('head')

    @stack('head')

</head>

<body>
