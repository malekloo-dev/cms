<section id="footer">


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
                                    href="{{ $subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external'? $subMenuItem['link']: '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
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
                                    href="{{ $subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external'? $subMenuItem['link']: '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="fourth-500">
                    <ul>
                        <li><a href="/رپورتاژ">رپورتاژ آگهی</a></li>
                        <li><a href="/تعرفه">تعرفه تبلیغات</a></li>
                        <li><a href="/اپلیکیشن">اپلیکیشن</a></li>
                    </ul>

                    <div>ما را دنبال کنید</div>
                    <div>
                        <a href="https://www.instagram.com/corepo2020/" target="_blank" rel="noopener">


                            <svg width="32px" height="32px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M363.273,0H148.728C66.719,0,0,66.719,0,148.728v214.544C0,445.281,66.719,512,148.728,512h214.544
               C445.281,512,512,445.281,512,363.273V148.728C512,66.719,445.281,0,363.273,0z M472,363.272C472,423.225,423.225,472,363.273,472
               H148.728C88.775,472,40,423.225,40,363.273V148.728C40,88.775,88.775,40,148.728,40h214.544C423.225,40,472,88.775,472,148.728
               V363.272z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,118c-76.094,0-138,61.906-138,138s61.906,138,138,138s138-61.906,138-138S332.094,118,256,118z M256,354
               c-54.037,0-98-43.963-98-98s43.963-98,98-98s98,43.963,98,98S310.037,354,256,354z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <circle cx="396" cy="116" r="20" />
                                    </g>
                                </g>
                            </svg>

                        </a>
                    </div>
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

@stack('scripts')


<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script>
@if (WebsiteSetting::where('variable', '=', 'phone')->first()?->value != '')
    <a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton"></a>
@endif



@if (url('/') == 'https://corepo.ir')
    <!-- Google Tag Manager -->
    <script async>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PVTXH97');
    </script>
    <!-- End Google Tag Manager -->
    @endif

</body>

</html>
