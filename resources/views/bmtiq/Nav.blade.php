<div class="mainnav-position t3-sl-nav ">
    <div class="mainnav-wrapper stuck-container">
        <div class="container ">
            <div class="row">


                <!-- LOGO -->
                <div class="col-sm-4">
                    <div class="logo">
                        <div class="logo-text">
                            <a href="{{ url('/') }}" title="Translog">

                                <span>BMT</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- //LOGO -->


                <div class="col-sm-8">
                    <nav id="t3-mainnav" class="navbar navbar-mainmenu t3-mainnav">
                        <div class="t3-mainnav-wrapper">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".t3-navbar-collapse">
                                    <i class="fa fa-bars"></i>HOME
                                </button>


                            </div>

                            <div class="t3-navbar t3-navbar-collapse navbar-collapse collapse">
                                <div class="t3-megamenu animate fading" data-duration="400" data-responsive="true">
                                    <ul itemscope itemtype="http://www.schema.org/SiteNavigationElement"
                                        class="nav navbar-nav level0">

                                        @foreach (App\Menu::where('parent', '=', '0')
                                            ->orderBy('sort')
                                            ->get()
                                        as $menuItem)
                                            @php $subMenu = App\Menu::where('menu', '=', '1')
                                            ->where('parent', '=', $menuItem['id'])
                                            ->orderBy('sort')
                                            ->get(); @endphp
                                            @if (count($subMenu))
                                                <li class="parent"><a
                                                        href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>

                                                    <ul>
                                                        @foreach ($subMenu as $subMenuItem)
                                                            <li><a
                                                                    href="{{ $subMenuItem['type'] == 'internal' ? $subMenuItem['link'] : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="">
                                                    <a class="fullwidth" href="{{ $menuItem['type'] == 'internal' ? $menuItem['link'] : '/#' . $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                                                </li>

                                            @endif

                                        @endforeach


                                    </ul>
                                </div>

                            </div>
                        </div>
                    </nav>
                </div>


            </div>
        </div>
    </div>
</div>
