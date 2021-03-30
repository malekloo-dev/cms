<section id="footer" >


    <section class="footer-links">
        <div class="container">
            <div class="flex one two-500">
                <div class="two-fourth-500">
                    <div>وبسایت ها</div>
                    <ul class="flex one two-700">
                        <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                        ->where('parent', '=', 7)
                        ->orderBy('sort')
                        ->get(); ?>
                        @foreach ($subMenu as $subMenuItem)
                            <li><a
                                    href="{{ $subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external' ? $subMenuItem['link'] : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="fourth-500">
                    <div>مقاله ها</div>
                    <ul class="flex one ">
                        <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                        ->where('parent', '=', 34)
                        ->orderBy('sort')
                        ->get(); ?>
                        @foreach ($subMenu as $subMenuItem)
                            <li><a
                                    href="{{ $subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external' ? $subMenuItem['link'] : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="fourth-500">
                    <ul>
                        <li><a href="/رپورتاژ">رپورتاژ</a></li>
                        <li><a href="/تعرفه">تعرفه</a></li>
                        <li><a href="/اپلیکیشن">اپلیکیشن</a></li>
                    </ul>
                    <div>خانواده ما</div>
                    <ul>
                        <li><a target="_blanck" href="https://darbkala.com">درب کالا</a></li>
                        <li><a target="_blanck" href="https://remotyadak.ir">ریموت یدک</a></li>
                        <li><a target="_blanck" href="https://corepo.ir">کریپو</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-copyright">
        <div class="container">
            <div class="flex one">
                <div class="text-center">
                    <div>ویژن شرکت corepo
                        ایجاد پلتفرم تبلیغاتی و آگهی می باشد.
                        ساخته شده توسط <a target="_blanck" href="https://tarhoweb.com">طرح و وب</a></div>
                </div>
            </div>
        </div>
    </section>
</section>
@yield('footer')
@yield('cropper')

<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;

</script>
<script src="{{ url('/main.js') }}"></script>
</body>

</html>
