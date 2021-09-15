<!-- section header -->
<header class="header bg-gray text-black " >
    <!-- header-profile -->
    <div class="header-profile @if(!$ltr) pull-left @endif">
        <div class="profile-nav">
            @auth
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <span class="profile-username disBlock pull-left">
                        <img class="img-circle mat-elevation-z4" src="{{ url('/adminAssets/img/profile-placeholder.jpg') }}"
                            alt="">
                    </span>
                </a>
                <ul class="dropdown-menu animated fadeInDown pull-right mat-elevation-z4" role="menu">
                    <li><a class="text-right left">{{ Auth::user()->name }}</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <button class="btn btn-link">@lang('messages.logout')</button>
                        </form>
                    </li>
                </ul>
            @endauth
        </div>
        <i class="fa fa-clock-o font-full-em-2 text-light-gray" data-toggle="tooltip" @if(!$ltr) data-placement='right' @else data-placement='left' @endif'   title="{{ convertGToJ('now') }}"></i>



    </div><!-- header-profile -->

    <!-- header brand -->
    <div class="header-brand " >
        <a href="{{ url('/admin') }}"><img height="40"  src="/{{ asset('/img/logo1x.png') }}"
                class="liveChatLogo pull-left"></a>
    </div>

    <a id="toggleSideBar"><i class="fa fa-bars"></i></a>

</header>
<!--/header-->
