<!DOCTYPE html>
<html lang="fa">
<head>
    <title>{{$seo['meta_title'] ?? "" }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo['meta_keywords'] ?? "" }}">
    <meta name="description" content="{{$seo['meta_description']  ?? ""}}">

    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="theme-color" content="#fa490e"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fa490e">
    <meta name="apple-mobile-web-app-title" content="ریموت">
    <link rel="apple-touch-icon" href="{{ asset('/img/logo-96-96.png') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('/img/logo-192-192.png') }}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{ asset('/img/logo-256-256.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('/img/logo-512-512.png') }}">

    <meta name="msapplication-TileImage" content="{{ asset('/img/logo-192-192.png') }}">
    <meta name="msapplication-TileColor" content="#fa490e">
    <meta name="msapplication-square96x96logo" content="{{ asset('/img/logo-96-96.png') }}">
    <meta name="msapplication-square152x152logo" content="{{ asset('/img/logo-152-152.png') }}">

    <link rel="stylesheet" href="{{ asset('/style.css') }}">
    <link rel="icon" href="{{ asset('/img/fav.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="{{$seo['og:type'] ?? "" }}">
    <meta property="og:title" content="{{$seo['meta_title'] ?? "" }}">
    <meta property="og:description" content="{{$seo['meta_description']  ?? ""}}">
    <meta property="og:url" content="{{ Request::url() ?? $seo['url'] }}">
    <meta property="og:image" content="{{ asset('/img/logo2x.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <!-- <meta property="og:image:width" content="405">
    <meta property="og:image:height" content="300"> -->

    <script>
        // document.addEventListener('DOMContentLoaded', (e) => {
        //     var element = document.getElementsByTagName("html");
        //     element.classList.add("loaded");

        // });
    </script>
    @yield('assets')
</head>

<body>
