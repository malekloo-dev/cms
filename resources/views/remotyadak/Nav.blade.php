<nav>
    <a href="/" class="brand">
        <img alt="ریموت یدک لوگو" srcset="{{ asset('/img/logo1x.png') }} 1x, {{ asset('/img/logo2x.png') }} 2x" src="{{ asset('/img/logo1x.png') }}" />
    </a>


    <input id="bmenu"  name="bmenu" type="checkbox" class="show" aria-label="menu">

    <label for="bmenu"  id="bmenu1" class="burger toggle pseudo button">
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
    </script>--}}
    <div class="menu">

        <ul>
            {{--<li>
                <a class="flexbox">
                    <div class="search1">
                        <div>
                            <input alt="جستجو" type="text" placeholder="جستجو" required>
                        </div>
                    </div>
                </a>
            </li>--}}
            @foreach(Harimayco\Menu\Models\MenuItems::where('menu', '=', '1')->where('parent','=','0')->orderBy('sort')->get() as $menuItem)
            <?php
            $subMenu = Harimayco\Menu\Models\MenuItems::where('menu', '=', '1')->where('parent', '=', $menuItem['id'])->orderBy('sort')->get(); ?>
            @if(count($subMenu))
            <li class="parent"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                <div><img src="{{ asset('/img/arrow-down.png') }}"></div>
                <ul>
                    @foreach($subMenu as $subMenuItem)
                    <li><a href="{{ $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            @else
            <li><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a></li>

            @endif

            @endforeach
        </ul>
    </div>


</nav>
