<nav>
    <a href="/" class="brand">
        <img class="full" src="{{ asset('/img/logo.png') }}">
    </a>

    <input id="bmenu" type="checkbox" class="show">
    <label for="bmenu" class="burger toggle pseudo button">
        <span class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </label>
    <div class="menu">

        <ul>
            @foreach(Harimayco\Menu\Models\MenuItems::where('menu', '=', '1')->where('parent','=','0')->get() as $menuItem)
                <?php
                $subMenu = Harimayco\Menu\Models\MenuItems::where('menu', '=', '1')->where('parent', '=', $menuItem['id'])->get()
                ?>
                @if(count($subMenu))
                <li class="parent"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                    <div><img src="{{ asset(@env('TEMPLATE_NAME').'/img/arrow-down.png') }}"></div>
                    <ul>
                        @foreach($subMenu as $subMenuItem)
                            <li><a href="{{ $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @else
                    <li><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a></li>

                @endif

            @endforeach

            {{--<li><a href="/">خانه</a></li>
            <li class="parent"><a href="/طراحی-سایت">طراحی سایت</a>
                <div><img src="{{ asset('/img/arrow-down.png') }}"></div>
                <ul>
                    <li><a href="/طراحی-سایت-وردپرس">طراحی سایت وردپرس</a></li>
                    <li><a href="/طراحی-سایت-حرفه-ای">طراحی سایت حرفه ای</a></li>
                    <li><a href="/نمونه-طراحی-سایت">نمونه طراحی سایت</a></li>
                </ul>
            </li>
            <li class="parent"><a href="/سئو-سایت">سئو سایت</a>
                <div><img src="{{ asset('img/arrow-down.png') }}"></div>
                <ul>
                    <li><a href="نمونه-کار-سئو">نمونه کار سئو</a></li>

                </ul>
            </li>
            <li class=" parent"><a href="/تعرفه">تعرفه</a>
                <div><img src="{{ asset('img/arrow-down.png') }}"></div>
                <ul>
                    <li><a href="/تعرفه-سئو-سایت">تعرفه سئو سایت</a></li>
                    <li><a href="/تعرفه-طراحی-سایت">تعرفه طراحی سایت</a></li>
                </ul>
            </li>
            <li><a href="/بلاگ">بلاگ</a></li>
            <li><a href="/درباره-ما">درباره ما</a></li>
            <li><a href="/تماس-با-ما">تماس با ما</a></li>--}}
        </ul>
    </div>
</nav>
