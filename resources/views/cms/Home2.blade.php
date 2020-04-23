<!DOCTYPE html>
<html lang="en">
<head>
    <title>دکور</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="css, library, picnic, picnicss, light">
    <meta name="description" content="A lightweight CSS library">
    <link href="{{ asset('css/user/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/user/logo.png') }}" type="image/png">

    <!--<link rel="stylesheet" href="https://unpkg.com/picnic">-->
    <link rel="stylesheet" media="bogus">
</head>
<body>
<nav>
    <a href="/" class="brand">
        <img class="full" src="{{ asset('img/user/logo.png') }}">
    </a>
    <div class="search">
        <form method="post" href="search.html">
            <input class="search-input" placeholder="جستجو در دکور ...">
        </form>
    </div>
    <input id="bmenu" type="checkbox" class="show">
    <label for="bmenu" class="burger toggle pseudo button">منو</label>
    <div class="menu">
        <a href="/" class="pseudo button">خانه</a>
        <a href="/decor" target="_blank" class=" pseudo button ">دکور</a>
        <a href="/about-us" class="button pseudo">درباره ما</a>
        <a href="/contact-us" class="button pseudo">تماس با ما</a>
    </div>
</nav>
<main class="intro test" style="">
    <div class="flex one " id="index-category">
        <div class="full">
            <div class="shadow" style="padding:1em 10em; ">
                <div class="flex six center ">
                    <a href="1">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                    <a href="2">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                    <a href="3">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                    <a href="4">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                    <a href="5">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                    <a href="6">
                        <img src="{{ asset('img/user/room.jpg')}}">
                        <div>اتاق خواب</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex one " id="index-best">
        <div class="full">
            <div class="shadow" style="padding:1em 1em; ">
                <h2>مطالب پر بازدید دکوراسیون</h2>
                <div class="flex four  center ">
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best1.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="flex one" id="index-comment" >
        <div class="full">
            <div>برترین سایت معرفی شرکت های تولید کننده و هدماتی در زمینه دکوراسیون</div>
        </div>
    </div>
    <div class="flex one " id="index-best-view">
        <div class="full">
            <div class="shadow" style="padding:1em 1em; ">
                <h2>مطالب پر بازدید دکوراسیون</h2>
                <div class="flex four  center ">
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best1.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>
                    <div>
                        <article>
                            <div><img src="{{ asset('img/user/best2.jpg')}}"></div>
                            <footer>
                                <h3><a href="#">اتاق خواب</a></h3>
                                <p>اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب اتاق خواب</p>
                            </footer>
                        </article>
                    </div>


                </div>
            </div>
        </div>
    </div>



</main>
<script>window.onload = function () {

        // Dropimage handler
        [].forEach.call(document.querySelectorAll('.dropimage'), function (img) {
            img.onchange = function (e) {
                var inputfile = this, reader = new FileReader();
                reader.onloadend = function () {
                    inputfile.style['background-image'] = 'url(' + reader.result + ')';
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    };
</script>
<script src="/web/tracking.js" defer async></script>
</body>
</html>