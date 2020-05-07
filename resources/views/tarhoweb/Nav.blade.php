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

            <li class="parent"><a href="/ساخت-سوئیچ-ساخت-ریموت" >طراحی سایت</a>
                <button><img src="{{ asset(@env('TEMPLATE_NAME').'/img/arrow-down.png') }}"></button>
                <ul>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" >طراحی سایت وردپرس</a></li>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" >طراحی سایت حرفه ای</a></li>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" >نمونه طراحی سایت</a></li>
                </ul>
            </li>
            <li class="parent"><a href="/ساخت-سوئیچ-ساخت-ریموت" >سئو سایت</a>
                <button><img src="{{ asset(@env('TEMPLATE_NAME').'/img/arrow-down.png') }}"></button>
                <ul>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" ">نمونه کار سئو</a></li>
                </ul>
            </li>
            <li class="parent"><a href="/ساخت-سوئیچ-ساخت-ریموت" >تعرفه</a>
                <button><img src="{{ asset(@env('TEMPLATE_NAME').'/img/arrow-down.png') }}"></button>
                <ul>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" >تعرفه سئو سایت</a></li>
                    <li><a href="/ساخت-سوئیچ-ساخت-ریموت" >تعرفه طراحی سایت</a></li>
                </ul>
            </li>
            <li><a href="/درباره-ما" >بلاگ</a></li>
            <li><a href="/درباره-ما" >درباره ما</a></li>
            <li><a href="/تماس-با-ما">تماس با ما</a></li>
        </ul>
    </div>
</nav>
