<div class="top-menu">
    <section class="p-0 m-0">

        <div class="text-center">
            <a href="/" class="brand">
                <img height="120" width="89" alt=" ایدن لوگو"
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

                    <ul class="p-0 m-0 ">

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
                        <li><a
                            href="{{ route('search') }}">جستجوگر</a>
                        </li>

                    </ul>
                </div>


            </nav>

        </div>
    </section>
</div>
