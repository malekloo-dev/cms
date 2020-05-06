
<nav>
    <a href="/" class="brand">
        <img class="full" src="{{ asset(@env('TEMPLATE_NAME').'/img/user/logo.png') }}">
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
        <a href="/" class="pseudo button">خانه</a>
        <a href="/ساخت-سوئیچ-ساخت-ریموت"  class=" pseudo button ">ساخت سوئیچ و ریموت</a>
        <a href="/about-us" class="button pseudo">درباره ما</a>
        <a href="/contact-us" class="button pseudo">تماس با ما</a>
    </div>
</nav>
