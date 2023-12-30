<div class="top-menu">
    <div class="customer-menu text-sm">

        @auth
            @role('customer')
                <span class="relative" onclick="window.location.href='{{ route('customer.cart.list') }}'">
                    <i class="fa-solid fa-basket-shopping"></i> سبد خرید
                    <span
                        class="absolute -right-7 top-0 rounded-full bg-red-400 w-5 h-5 top text-xs right p-1 m-0 text-white leading-tight text-center">
                        {{ \Cart::session(getSession('cart'))->getContent()->count() ?? 0 }}
                    </span>
                </span>

                {{-- <span onclick="window.location.href='{{ route('customer.order.list') }}'"> سفارشات </span> --}}
                <span class="login" onclick="window.location.href='{{ route('customer.order.list') }}'"><i
                        class="far fa-user"></i></span>
                {{-- <span onclick="window.location.href='{{ route('customer.dashboard') }}'">حساب کاربری</span> --}}
            @else
                <span onclick="window.location.href='{{ route('company.dashboard') }}'">حساب کمپانی</span>
            @endrole
        @else
            <span class="relative " onclick="window.location.href='{{ route('customer.cart.list') }}'">
                <i class="fa-solid fa-basket-shopping"></i> سبد خرید
                <span
                    class="absolute -right-7 top-0 rounded-full bg-red-400 w-5 h-5 top text-xs right p-1 m-0 text-white leading-tight text-center">
                    {{ \Cart::session(getSession('cart'))->getContent()->count() ?? 0 }}
                </span>
            </span> |‌

            <span class="" onclick="window.location.href='{{ route('login') }}'">ورود</span>
        @endauth
    </div>


    <header class='border-b py-1 px-1 lg:px-5  bg-white font-sans min-h-[70px] '>
        <div class='flex flex-wrap items-center lg:gap-y-2 gap-y-4 gap-x-4'>
            <a href="/" class="">
                <img height="60" width="44" alt=" ایدن لوگو" class="inline-block"
                    srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                    src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
            </a>
            <div class='flex items-center mr-auto lg:order-1'>

                <a class="mr-6 " href="https://www.instagram.com/eden.gold.gallery/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" class="cursor-pointer " viewBox="0 0 24 24">
                        <linearGradient id="a" x1="-37.106" x2="-26.555" y1="-72.705" y2="-84.047"
                            gradientTransform="matrix(0 -1.98 -1.84 0 -132.522 -51.077)" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#fd5" />
                            <stop offset=".5" stop-color="#ff543e" />
                            <stop offset="1" stop-color="#c837ab" />
                        </linearGradient>
                        <path fill="url(#a)"
                            d="M1.5 1.633C-.386 3.592 0 5.673 0 11.995c0 5.25-.916 10.513 3.878 11.752 1.497.385 14.761.385 16.256-.002 1.996-.515 3.62-2.134 3.842-4.957.031-.394.031-13.185-.001-13.587-.236-3.007-2.087-4.74-4.526-5.091C18.89.029 18.778.005 15.91 0 5.737.005 3.507-.448 1.5 1.633z"
                            data-original="url(#a)" />
                        <path fill="#fff"
                            d="M11.998 3.139c-3.631 0-7.079-.323-8.396 3.057-.544 1.396-.465 3.209-.465 5.805 0 2.278-.073 4.419.465 5.804 1.314 3.382 4.79 3.058 8.394 3.058 3.477 0 7.062.362 8.395-3.058.545-1.41.465-3.196.465-5.804 0-3.462.191-5.697-1.488-7.375-1.7-1.7-3.999-1.487-7.374-1.487zm-.794 1.597c7.574-.012 8.538-.854 8.006 10.843-.189 4.137-3.339 3.683-7.211 3.683-7.06 0-7.263-.202-7.263-7.265 0-7.145.56-7.257 6.468-7.263zm5.524 1.471a1.063 1.063 0 1 0 0 2.126 1.063 1.063 0 0 0 0-2.126zm-4.73 1.243a4.55 4.55 0 1 0 .001 9.101 4.55 4.55 0 0 0-.001-9.101zm0 1.597c3.905 0 3.91 5.908 0 5.908-3.904 0-3.91-5.908 0-5.908z"
                            data-original="#ffffff" />
                    </svg></a>


                <button id="toggle" class='lg:hidden mr-7'>
                    <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <ul id="collapseMenu"
                class='lg:!flex lg:mr-10 lg:space-x-8 lg:space-x-reverse max-lg:space-y-2 max-lg:hidden max-lg:w-full max-lg:my-4'>
                @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get() as $menuItem)
                    <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                        ->where('parent', '=', $menuItem['id'])
                        ->orderBy('sort')
                        ->get(); ?>
                    @if (count($subMenu))
                        <li class='max-lg:border-b max-lg:py-2 md:mb-0 relative parent '>
                            <a href="{{ $menuItem['link'] }}"
                                class='lg:hover:text-[#007bff] text-gray-600 block font-bold text-[15px] lg:group-hover:ul md:ml-5'>
                                <i class="arrow down left-10 md:left-1  border-gray-400"></i>{{ $menuItem['label'] }}
                            </a>

                            <ul class="hidden submenu ">
                                @foreach ($subMenu as $subMenuItem)
                                    <li><a class="lg:hover:text-[#007bff] text-gray-600 block font-bold text-[15px] py-2 pr-10 md:pr-0"
                                            href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                    </li>
                                @endforeach
                                <li class="lg:hidden">
                                    <a class="text-yellow-600  block font-bold text-[15px]"
                                        href="{{ $menuItem['link'] }}">همه محصولات {{ $menuItem['label'] }}</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class='max-lg:border-b max-lg:py-2 md:mb-0'>
                            <a href='{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . $menuItem['link'] }}'
                                class='lg:hover:text-[#007bff] text-gray-600  block font-bold text-[15px]'>{{ $menuItem['label'] }}</a>
                        </li>
                    @endif
                @endforeach





            </ul>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var toggleBtn = document.getElementById('toggle');
        var collapseMenu = document.getElementById('collapseMenu');

        function handleClick() {
            if (collapseMenu.style.display === 'block') {
                collapseMenu.style.display = 'none';
            } else {
                collapseMenu.style.display = 'block';
            }
        }

        toggleBtn.addEventListener('click', handleClick);



        if ($(window).width() <= 1023) {
            $('.parent > a').attr('href', '#')
        }

        $(document).ready(function() {
            if ($(window).width() <= 1023) {
                $(".parent > a").click(function() {
                    $(this).next(".submenu").toggleClass("hidden");
                });
            } else {
                $(".parent").hover(function() {
                    $(this).find(".submenu").addClass("hover");
                },function() {
                    $(this).find(".submenu").removeClass("hover");
                });
            }
        });
    </script>

    <section class="p-0 m-0 hidden">

        <div class="text-center">
            <a href="/" class="brand hidden">
                <img height="60" width="44" alt=" ایدن لوگو" class="inline-block"
                    srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                    src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
            </a>
            <nav class="top">
                <input id="bmenu" name="bmenu" type="checkbox" class="show" aria-label="menu">

                <label for="bmenu" id="bmenu1" class="burger toggle pseudo button">
                    <span class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                </label>
                <div class="menu " style="margin: 0 auto">



                    <ul class="p-0 m-0  flex-wrap w-11/12">

                        @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get() as $menuItem)
                            <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                                ->where('parent', '=', $menuItem['id'])
                                ->orderBy('sort')
                                ->get(); ?>
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
                        @endforeach
                        <li><a href="{{ route('search') }}">جستجوگر</a>
                        </li>

                    </ul>
                </div>


            </nav>

        </div>
    </section>


</div>
