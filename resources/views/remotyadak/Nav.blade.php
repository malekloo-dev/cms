<nav>
    <a href="/" class="brand">
        <img class="full" src="{{ asset(@env('TEMPLATE_NAME').'/img/logo.png') }}">
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
            <li><a href="/">خانه</a></li>
            <li><a href="/بلاگ">بلاگ</a></li>
            <li class="parent"><a href="/ساخت-سوئیچ">ساخت ریموت و سوئیچ</a>
                <ul>
                    @foreach(App\Category::where('type', '=', '1')->where('parent_id','<>','0')->get() as $menuItem)
                    <li><a href="{{ $menuItem['slug'] }}">{{ $menuItem['title'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/درباره-ما">درباره ما</a></li>
            <li><a href="/تماس-با-ما">تماس با ما</a></li>
        </ul>
    </div>
</nav>
