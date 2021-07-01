<div class="top-menu">
    <section class="p-0 m-0">
        <div class="">
            <nav>
                <a href="/" class="brand">
                    <img height="80" width="100" alt=" درب کالا لوگو"
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
                        @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get()
    as $menuItem)
                            @php
                                $subMenu = App\Models\Menu::where('menu', '=', '1')
                                    ->where('parent', '=', $menuItem['id'])
                                    ->orderBy('sort')
                                ->get(); @endphp
                            @if (count($subMenu))

                                <li class="parent">
                                    <a href="{{ url($menuItem['link']) }}">{{ $menuItem['label'] }} </a>
                                    <div><i class="arrow down"></i></div>
                                    <ul>
                                        @foreach ($subMenu as $subMenuItem)

                                            @php
                                                $subMenu2 = App\Models\Menu::where('menu', '=', '1')
                                                    ->where('parent', '=', $subMenuItem['id'])
                                                    ->orderBy('sort')
                                                ->get(); @endphp

                                            @if (count($subMenu2))

                                                <li class="parent">
                                                    <a
                                                        href="{{ url($subMenuItem['link']) }}">{{ $subMenuItem['label'] }}</a>

                                                    <div><i class="arrow left"></i></div>
                                                    <ul>
                                                        @foreach ($subMenu2 as $subMenuItem2)
                                                            <li><a
                                                                    href="{{ in_array($subMenuItem2['type'], ['internal', 'external']) ? url($subMenuItem2['link']) : '/#' . url($subMenuItem2['link']) }}">
                                                                    {{ $subMenuItem2['label'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . url($subMenuItem['link']) }}">
                                                        {{ $subMenuItem['label'] }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a
                                        href="{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . url($menuItem['link']) }}">
                                        {{ $menuItem['label'] }}
                                    </a>
                                </li>

                            @endif

                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </section>
</div>
