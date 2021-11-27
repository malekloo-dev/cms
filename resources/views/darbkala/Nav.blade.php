<div class="top-menu">
    <section class="p-0 m-0">

        <div class="">

            <nav class="top">
                <a href="/" class="brand">
                    <img height="60" width="" alt=" درب کالا لوگو"
                        srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                        src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
                </a>


                <input id="bmenu" name="bmenu" type="checkbox" class="show" aria-label="menu">

                <label for="bmenu" id="bmenu1" class="burger toggle pseudo button">
                    <span class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                </label>
                {{-- <script>
                function myFunction() {
                    var element = document.getElementById("bmenu1");
                    element.classList.add("burger");
                    element.classList.add("toggle");
                    element.classList.add("pseudo");
                    element.classList.add("button");
                }

                myFunction();
                }

                </script> --}}
                <div class="menu">

                    <ul>
                        {{-- <li>
                        <a class="flexbox">
                            <div class="search1">
                                <div>
                                    <input alt="جستجو" type="text" placeholder="جستجو" required>
                                </div>
                            </div>
                        </a>
                    </li> --}}
                        {{-- @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get()
    as $menuItem)
                            @php $subMenu = App\Models\Menu::where('menu', '=', '1')
                            ->where('parent', '=', $menuItem['id'])
                            ->orderBy('sort')
                            ->get(); @endphp
                            @if (count($subMenu))
                                <li class="parent"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                                    <div><i class="arrow down"></i></div>
                                    <ul>
                                        @foreach ($subMenu as $subMenuItem)
                                            <li><a
                                                    href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a
                                        href="{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                                </li>
                            @endif
                        @endforeach --}}



                        <li class="parent">
                            <a href="">خانه</a>
                        </li>

                        <li class="parent">
                            <a href="">درباره ما</a>
                        </li>


                        <li class="parent">
                            <a href="">تماس با ما</a>
                        </li>



                        @auth
                            <li>
                                <a href="{{ route('company.dashboard') }}">پروفایل</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">ورود</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">ثبت نام</a>
                            </li>
                        @endauth
                    </ul>
                </div>


            </nav>





            <div class="nav-mega">
                <nav>
                    <a href="javascript:void(0);" class="mobile-menu-trigger">دسته بندی ها</a>
                    <ul class="menu menu-bar">
                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">درب ضد
                                سرقت</a>
                            <ul class="mega-menu mega-menu--flat">
                                <li>
                                    <a href="#" class="menu-link mega-menu-link mega-menu-header">درب ضد سرقت</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                درب ضد سرقت ترک
                                                {{-- <br /><small>Short decription of link</small> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                درب ضد سرقت ایرانی
                                                {{-- <br /><small>Short decription of link</small> --}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                درب ضد سرقت چینی
                                                {{-- <br /><small>Short decription of link</small> --}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mega-menu-content">
                                    <p class="mega-menu-header">لیست انواع درب ضد سرقت</p>
                                    <p>محتوای توضیحی در مورد درب ضد سرقت به همراه عکس محتوای توضیحی در مورد درب ضد سرقت به همراه عکس
                                        محتوای توضیحی در مورد درب ضد سرقت به همراه عکس
                                    </p>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">درب
                                لابی</a>
                            <ul class="mega-menu mega-menu--flat">
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.1 Page link
                                        header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.2 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.2 Page link
                                        header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.3 Page link
                                        header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>




                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">انواع درب
                                ورودی</a>
                            <ul class="mega-menu mega-menu--multiLevel">
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link"
                                        aria-haspopup="true">لیست درب ضد سرقت</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.1.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="menu-link menu-list-link"
                                                aria-haspopup="true">1.1.2 Flyout link</a>
                                            <ul class="menu menu-list">
                                                <li>
                                                    <a href="/page" class="menu-link menu-list-link">1.1.2.1 Page
                                                        link</a>
                                                </li>
                                                <li>
                                                    <a href="/page" class="menu-link menu-list-link">1.1.2.2 Page
                                                        link</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.1.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link"
                                        aria-haspopup="true">1.2 Flyout
                                        link</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.2.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link"
                                        aria-haspopup="true">1.3 Flyout
                                        link</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.3.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.3.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link">1.4 Page link</a>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">درب ضد
                                حریق</a>
                            <ul class="mega-menu mega-menu--flat">
                                <li>
                                    <a href="#" class="menu-link mega-menu-link mega-menu-header">3.1 Page link
                                        header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.1 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.2 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.2 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mega-menu-content">
                                    <p class="mega-menu-header">3.2 Page link header</p>
                                    <p>This is just static content. You can add anything here. Images, text, buttons,
                                        your grandma's
                                        secrect
                                        recipe.</p>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>



                        {{-- mobile  --}}
                        <li class="mobile-menu-header">
                            <a href="{{ url('/') }}" class="">
                                <span>صفحه اصلی سایت</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>






            {{-- <div class="nav-mega">
                <nav>
                    <a href="javascript:void(0);" class="mobile-menu-trigger">Open mobile menu</a>
                    <ul class="menu menu-bar">
                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">1. Multilevel mega
                                menu</a>
                            <ul class="mega-menu mega-menu--multiLevel">
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.1 Flyout
                                        link</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.1.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="menu-link menu-list-link"
                                                aria-haspopup="true">1.1.2 Flyout link</a>
                                            <ul class="menu menu-list">
                                                <li>
                                                    <a href="/page" class="menu-link menu-list-link">1.1.2.1 Page link</a>
                                                </li>
                                                <li>
                                                    <a href="/page" class="menu-link menu-list-link">1.1.2.2 Page link</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.1.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.2 Flyout
                                        link</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.2.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.3 Flyout
                                        link</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.3.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">1.3.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link">1.4 Page link</a>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">2. Flat mega menu (3
                                cols)</a>
                            <ul class="mega-menu mega-menu--flat">
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.1 Page link header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.2 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.1.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.2 Page link header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.3 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.3 Page link header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">3. Flat mega menu (2
                                cols)</a>
                            <ul class="mega-menu mega-menu--flat">
                                <li>
                                    <a href="#" class="menu-link mega-menu-link mega-menu-header">3.1 Page link header</a>
                                    <ul class="menu menu-list">
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.1 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.2 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/page" class="menu-link menu-list-link">
                                                3.1.2 Page link<br />
                                                <small>Short decription of link</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mega-menu-content">
                                    <p class="mega-menu-header">3.2 Page link header</p>
                                    <p>This is just static content. You can add anything here. Images, text, buttons, your grandma's
                                        secrect
                                        recipe.</p>
                                </li>
                                <li class="mobile-menu-back-item">
                                    <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="/page" class="menu-link menu-bar-link">Static link</a>
                        </li>

                        <li class="mobile-menu-header">
                            <a href="/home" class="">
                                <span>Home</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </section>
</div>
