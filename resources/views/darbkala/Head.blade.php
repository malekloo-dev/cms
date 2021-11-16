<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
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
        })(window, document, 'script', 'dataLayer', 'GTM-N7K7MGC');
    </script>
    <!-- End Google Tag Manager -->

    <title>{{ $seo['meta_title'] ?? '' }}@yield('meta-title')</title>
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

    <link rel="stylesheet" href="{{ mix('/' . env('TEMPLATE_NAME') . '.css', env('TEMPLATE_NAME')) }}">
    <link rel="icon" href="{{ url(env('TEMPLATE_NAME') . '/img/fav.png') }}" type="image/png">
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

    {{-- <script src="https://www.p30rank.ir/google" async></script> --}}
    @yield('head')

    @stack('head')

</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N7K7MGC" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
