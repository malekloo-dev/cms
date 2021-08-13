<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
    <title>{{$seo['meta_title'] ?? "" }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{$seo['meta_keywords'] ?? "" }}">
    <meta name="description" content="{{$seo['meta_description']  ?? ""}}">

    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="theme-color" content="#fff"/>

    <link rel="apple-touch-icon" href="{{ asset('/img/logo-96-96.png') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('/img/logo-192-192.png') }}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{ asset('/img/logo-256-256.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('/img/logo-512-512.png') }}">


    @yield('bootstrap')


    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('/img/fav.png') }}" type="image/x-icon">
    <link rel="stylesheet" media="bogus">


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yield('twitter:site',env('TEMPLATE_NAME'))">
    <meta name="twitter:title" content="@yield('twitter:title',$seo['meta_title']??'')" />
    <meta name="twitter:description" content="@yield('twitter:description',$seo['meta_description']??'')" />
    <meta name="twitter:creator" content="@yield('twitter:creator',env('TEMPLATE_NAME'))">
    <meta name="twitter:domain" content="@yield('twitter:domain',url('/'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="@yield('twitter:image', url(env('TEMPLATE_NAME') . '/img/logo-96-96.png') )">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="@yield('og:type',$seo['og:type']??'') ">
    <meta property="og:title" content="@yield('og:title',$seo['meta_title']??'')">
    <meta property="og:description" content="@yield('og:description',$seo['meta_description']??'')">
    <meta property="og:url" content="{{ Request::url() ?? $seo['url'] }}">
    <meta property="og:image" content="@yield('og:image',url(env('TEMPLATE_NAME') . '/img/logo-96-96.png'))" />
    <meta property="og:image:type" content="@yield('og:image:type','image/png')" />
    <meta property="og:image:width" content="@yield('og:image:width','20')" />
    <meta property="og:image:height" content="@yield('og:image:height','20')" />
    <meta property="og:image:alt" content="@yield('og:image:alt',$seo['meta_title']??'')" />


    @yield('head')

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WM7PKRW');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
