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











        </div>
    </section>


</div>

<section class="bg-white p-0 m-0">
    <div class="nav-mega">
        <nav>
            <a href="javascript:void(0);" class="mobile-menu-trigger">
                <span class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                دسته بندی ها</a>

            <ul class="menu menu-bar">
                <li>
                    <a href="javascript:void(0);" data-link="/درب-ضد-سرقت" class="menu-link menu-bar-link"
                        aria-haspopup="true">درب ضد سرقت</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/درب-ضد-سرقت" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه ی موارد درب ضد
                                سرقت</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-ضد-سرقت-ترک" class="menu-link menu-list-link">
                                        درب ضد سرقت ترک
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="/درب-ضد-سرقت-چینی" class="menu-link menu-list-link">
                                        درب ضد سرقت ایرانی
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="/درب-ضد-سرقت-ایرانی" class="menu-link menu-list-link">
                                        درب ضد سرقت چینی
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mega-menu-content">
                            <p class="mega-menu-header">لیست انواع درب ضد سرقت</p>
                            <p>محتوای توضیحی در مورد درب ضد سرقت به همراه عکس محتوای توضیحی در مورد درب ضد سرقت به همراه
                                عکس
                                محتوای توضیحی در مورد درب ضد سرقت به همراه عکس
                            </p>
                        </li>
                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-link="/درب-لابی" class="menu-link menu-bar-link"
                        aria-haspopup="true">درب
                        لابی</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/درب-لابی" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه
                                ی موارد درب لابی</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-لابی-یک-لنگه" class="menu-link menu-list-link">درب لابی یک لنگه</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-دولنگه" class="menu-link menu-list-link">درب لابی دولنگه</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-شیشه-خور" class="menu-link menu-list-link">درب لابی شیشه خور</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-لابی-چوبی" class="menu-link menu-list-link">درب لابی چوبی</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-فلزی" class="menu-link menu-list-link">درب لابی فلزی</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-شیشه-ای" class="menu-link menu-list-link">درب لابی شیشه ای</a>
                                </li>

                            </ul>

                        </li>
                        <li>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-لابی-آهنی" class="menu-link menu-list-link">درب لابی آهنی</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-پارکینگی" class="menu-link menu-list-link">درب لابی پارکینگی</a>
                                </li>
                                <li>
                                    <a href="/درب-لابی-ضد-سرقت" class="menu-link menu-list-link">درب لابی ضد سرقت</a>
                                </li>
                            </ul>
                        </li>

                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>




                <li>
                    <a href="javascript:void(0);" data-link="/درب-ورودی" class="menu-link menu-bar-link"
                        aria-haspopup="true">انواع درب
                        ورودی</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/درب-ورودی" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه ی
                                موارد درب ورودی</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-ورودی-باغ" class="menu-link menu-list-link">درب باغ</a>
                                </li>
                                <li>
                                    <a href="/درب-ورودی-پارکینگ" class="menu-link menu-list-link">درب پارکینگ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-ورودی-ریلی" class="menu-link menu-list-link">درب ریلی</a>
                                </li>

                                <li>
                                    <a href="/درب-ورودی-ویلا" class="menu-link menu-list-link">درب ویلا</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-ورودی-ساختمان" class="menu-link menu-list-link">درب ساختمان</a>
                                </li>
                                <li>
                                    <a href="/درب-ورودی-بانکی-و-امنیتی" class="menu-link menu-list-link">درب بانکی و
                                        امنیتی</a>
                                </li>
                            </ul>
                        </li>

                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-link="/درب-ضد-حریق" class="menu-link menu-bar-link"
                        aria-haspopup="true">درب ضد
                        حریق</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="درب-ضد-حریق" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه ی موارد درب ضد
                                حریق</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-ضد-حریق-فلزی" class="menu-link menu-list-link">
                                        درب ضد حریق فلزی
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="/درب-ضد-حریق-چوبی" class="menu-link menu-list-link">
                                        درب ضد حریق چوبی
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="/درب-ضد-حریق-شیشه-ای" class="menu-link menu-list-link">
                                        درب ضد حریق شیشه ای
                                        {{-- <br /><small>Short decription of link</small> --}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mega-menu-content">
                            <p class="mega-menu-header"> انواع درب ضد حریق</p>
                            <p>محتوای توضیحی در مورد درب ضد سرقت به همراه عکس محتوای توضیحی در مورد درب ضد سرقت به همراه
                                عکس
                                محتوای توضیحی در مورد درب ضد سرقت به همراه عکس
                            </p>
                        </li>
                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-link="/درب-اتوماتیک" class="menu-link menu-bar-link"
                        aria-haspopup="true">درب اتوماتیک</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/درب-اتوماتیک" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه ی
                                موارد درب اتوماتیک</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-اتوماتیک-شیشه-ای" class="menu-link menu-list-link">درب اتوماتیک شیشه
                                        ای</a>
                                </li>
                                <li>
                                    <a href="/درب-اتوماتیک-پارکینگ" class="menu-link menu-list-link">درب اتوماتیک
                                        پارکینگ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-اتوماتیک-کرکره-ای" class="menu-link menu-list-link">درب اتوماتیک کرکره
                                        ای</a>
                                </li>
                                <li>
                                    <a href="/درب-اتوماتیک-جک-برقی" class="menu-link menu-list-link">درب اتوماتیک جک
                                        برقی</a>
                                </li>
                                <li>
                                    <a href="/درب-اتوماتیک-سکشنال" class="menu-link menu-list-link">درب اتوماتیک
                                        سکشنال</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">

                                <li>
                                    <a href="/درب-اتوماتیک-بیمارستانی" class="menu-link menu-list-link">درب اتوماتیک
                                        بیمارستانی</a>
                                </li>
                                <li>
                                    <a href="/درب-اتوماتیک-راهبند-برقی" class="menu-link menu-list-link">درب اتوماتیک
                                        راهبند برقی</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul class="menu menu-list">

                                <li>
                                    <a href="/جک-درب-اتوماتیک" class="menu-link menu-list-link">جک روب اتوماتیک </a>
                                </li>
                                <li>
                                    <a href="/موتور-درب-ریلی" class="menu-link menu-list-link">موتور درب ریلی</a>
                                </li>
                            </ul>
                        </li>

                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-link="/سایر-درب-ها" class="menu-link menu-bar-link"
                        aria-haspopup="true">سایر درب ها</a>
                    <ul class="mega-menu mega-menu--multiLevel">

                        <li>
                            <a href="/سایر-درب-ها" class="menu-link mega-menu-link" hidden-desktop="true">همه موارد سایر
                                درب ها</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-link="/درب-حیاط" class="menu-link mega-menu-link"
                                aria-haspopup="true">درب
                                حیاط</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-حیاط" class="menu-link mega-menu-link" hidden-desktop="true">همه موارد
                                        درب
                                        حیاط</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-فلزی" class="menu-link menu-list-link">فلزی</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-آهنی" class="menu-link menu-list-link">آهنی</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-فرفورژه" class="menu-link menu-list-link">فرفورژه</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-ساختمان" class="menu-link menu-list-link">ساختمان</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-ویلا" class="menu-link menu-list-link">ویلا</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-چوبی" class="menu-link menu-list-link">چوبی</a>
                                </li>
                                <li>
                                    <a href="/درب-حیاط-برقی" class="menu-link menu-list-link">برقی</a>
                                </li>


                            </ul>

                        </li>
                        <li>
                            <a href="javascript:void(0);" data-link="/درب-داخلی" class="menu-link mega-menu-link"
                                aria-haspopup="true">درب داخلی</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/درب-داخلی" class="menu-link mega-menu-link" hidden-desktop="true">همه
                                        موارد
                                        درب
                                        داخلی</a>
                                </li>
                                <li>
                                    <a href="/درب-داخلی-MDF" class="menu-link menu-list-link">MDF</a>
                                </li>
                                <li>
                                    <a href="/درب-داخلی-HDF" class="menu-link menu-list-link">HDF</a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="/درب-کشویی" class="menu-link mega-menu-link">درب کشویی</a>
                        </li>
                        <li>
                            <a href="/درب-آکاردئونی" class="menu-link mega-menu-link">درب آکاردئونی</a>
                        </li>
                        <li>
                            <a href="/درب-UPVC" class="menu-link mega-menu-link">درب UPVC</a>
                        </li>
                        <li>
                            <a href="/درب-دوجداره" class="menu-link mega-menu-link">درب دوجداره</a>
                        </li>
                        <li>
                            <a href="/درب-اسطبلی" class="menu-link mega-menu-link">درب اسطبلی</a>
                        </li>
                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-link="/نصاب-درب" class="menu-link menu-bar-link"
                        aria-haspopup="true">نصاب درب</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/نصاب-درب" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه
                                ی موارد نصاب درب</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/نصاب-درب-ضد-سرقت" class="menu-link menu-list-link">نصاب درب ضد سرقت</a>
                                </li>
                                <li>
                                    <a href="/نصاب-درب-اتوماتیک" class="menu-link menu-list-link">نصاب درب اتوماتیک</a>
                                </li>
                                <li>
                                    <a href="/نصاب-درب-ضد-حریق" class="menu-link menu-list-link">نصاب درب ضد حریق</a>
                                </li>

                            </ul>
                        </li>



                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-link="/یراق-آلات" class="menu-link menu-bar-link"
                        aria-haspopup="true">یراق آلات</a>
                    <ul class="mega-menu mega-menu--flat">
                        <li>
                            <a href="/یراق-آلات" class="menu-link mega-menu-link mega-menu-header"
                                hidden-desktop="true">همه
                                ی موارد درب لابی</a>
                            <ul class="menu menu-list">
                                <li>
                                    <a href="/یراق-آلات-درب-ضد-سرقت" class="menu-link menu-list-link">یراق آلات درب ضد سرقت</a>
                                </li>
                                <li>
                                    <a href="/یراق-آلات-درب-ضد-حریق" class="menu-link menu-list-link">یراق آلات درب ضد حریق</a>
                                </li>
                                <li>
                                    <a href="/یراق-آلات-درب-اتوماتیک" class="menu-link menu-list-link">یراق آلات درب اتوماتیک</a>
                                </li>

                            </ul>
                        </li>



                        <li class="mobile-menu-back-item">
                            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">بازگشت</a>
                        </li>
                    </ul>
                </li>

                {{-- mobile --}}
                <li class="mobile-menu-header">
                    <a href="{{ url('/') }}" class="">
                        <span>صفحه اصلی سایت</span>
                    </a>
                </li>
            </ul>
            <div class="menu-bg"></div>
        </nav>
    </div>
</section>


@push('scripts')
    <script>
        if (window.screen.width > 900) {

            var items = document.querySelectorAll('[aria-haspopup="true"]');
            items.forEach(element => {
                element.setAttribute('href', element.getAttribute('data-link'));

                // console.log(element.getAttribute('href'));
            });
        }
    </script>
@endpush
