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
                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" class="cursor-pointer " viewBox="0 0 24 24">
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

                    <a class="mr-6 " target="__blank" href="https://api.whatsapp.com/send?phone=989374599840&text=سلام.%20میخواستم%20سفارش%20ثبت%20کنم">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 48 48">
                            <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"></path><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"></path><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"></path><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"></path><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"></path>
                            </svg>
                    </a>


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
                            <a href="{{ url($menuItem['link']) }}"
                                class='lg:hover:text-yellow-600 text-gray-600 block font-bold text-[15px] lg:group-hover:ul md:ml-5'>
                                <i class="arrow down left-10 md:left-1  border-gray-400"></i>{{ $menuItem['label'] }}
                            </a>

                            <ul class="hidden submenu ">
                                @foreach ($subMenu as $subMenuItem)
                                    <li><a class="lg:hover:text-yellow-600 text-gray-600 block font-bold text-[15px] py-2 pr-10 md:pr-0"
                                            href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                    </li>
                                @endforeach
                                <li class="lg:hidden">
                                    <a class="text-yellow-600  block font-bold text-[15px]"
                                        href="{{ url($menuItem['link']) }}">همه محصولات {{ $menuItem['label'] }}</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class='max-lg:border-b max-lg:py-2 md:mb-0'>
                            <a href='{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . $menuItem['link'] }}'
                                class='lg:hover:text-yellow-600 text-gray-600  block font-bold text-[15px]'>{{ $menuItem['label'] }}</a>
                        </li>
                    @endif

                @endforeach
                <li class='max-lg:border-b max-lg:py-2 md:mb-0'>
                    <a class="lg:hover:text-yellow-600 text-gray-600  block font-bold text-[15px]" href="{{ route('search') }}">جستجوگر</a>
                </li>




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



</div>
