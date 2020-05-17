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
            <li><a href="/ساخت-سوئیچ">ساخت ریموت و سوئیچ</a></li>
            <li><a href="/درباره-ما">درباره ما</a></li>
            <li><a href="/تماس-با-ما">تماس با ما</a></li>
        </ul>
    </div>
</nav>
