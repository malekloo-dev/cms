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
                <div><img src="{{ asset('/img/arrow-down.png') }}"></div>
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
        </ul>
    </div>
</nav>
