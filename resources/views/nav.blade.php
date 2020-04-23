{{--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index: 9999">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo of email campaign" width="50" height="50">
            LiveChat
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

</nav>--}}

<!-- section header -->
<header class="header bg-white text-black mat-elevation-z3">
    <!-- header-profile -->
    <div class="header-profile pull-right">
        <div class="profile-nav">
            @auth
            <a  class="dropdown-toggle" data-toggle="dropdown">
                <span class="profile-username disBlock pull-left">
                    <img class="img-circle mat-elevation-z4" src="{{ asset('img/profile-placeholder.jpg') }}" alt="">
                </span>
            </a>
            <ul class="dropdown-menu animated fadeInDown pull-right mat-elevation-z4" role="menu">
                <li><a class="text-left left">{{ Auth::user()->name }}</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            @endauth
        </div>
    </div><!-- header-profile -->

    <!-- header brand -->
    <div class="header-brand">
        <a href="{{ url('/') }}"><img src="{{ asset('img/abatalk-logo.svg') }}" class="liveChatLogo pull-left"></a>
    </div>

    <a id="toggleSideBar"><i class="fa fa-bars"></i></a>

</header><!--/header-->