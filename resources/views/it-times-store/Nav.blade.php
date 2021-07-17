<div class="top-menu">
    <section class="p-0 m-0">
        <div class="">
            <nav>
                <a href="/" class="brand">
                    <img height="64" width="64" alt=" کریپو لوگو"
                        srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                        src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
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
                        @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get()
    as $menuItem)
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
