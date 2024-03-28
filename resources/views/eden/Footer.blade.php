<footer class="wide" id="footer">
    <div class=" grid md:grid-cols-3 gap-x-5 md:py-10 max-md:px-5">
        <div class=" pt-1 ">
            <div class="font-bold border-b-2 border-[#ca8a04] inline-block mb-3 pl-20">اطلاعات تماس</div>
            <div class="text-gray-500">
                <div>
                    <a class=" block" href="/درباره-ما">درباره ما</a>
                    <a class=" block" href="/تماس-با-ما">تماس با ما</a>
                </div>

                <div>ساعت کاری:
                    <div class="text-gray-900">شنبه تا چهارشنبه ۹:۳۰ تا ۱۸</div>
                    <div class="text-gray-900">پنجشنبه ۹:۳۰ تا ۱۳</div>
                </div>
                <div>شماره تماس:
                    <div><a href="">۰۹۳۷۴۵۹۹۸۴۰</a></div>
                </div>
                <div class="">آدرس کارگاه:
                    <div class="text-gray-900">بازار بزرگ، ناصر خسرو، بن بست خادم</div>
                </div>

            </div>
        </div>
        <div class="">
            <div class="font-bold border-b-2 border-[#ca8a04] inline-block mb-3 pl-20">پربازدید ها</div>
            <div>
                <a class=" block" href="/category/انگشتر-طلا-زنانه">انگشتر طلا زنانه</a>
                <a class=" block" href="/دستبند-طلا-زنانه">دستبند طلا زنانه</a>
                <a class=" block" href="/گردنبند-طلا-زنانه">گردنبند طلا زنانه</a>
                <a class=" block" href="/گوشواره">گوشواره طلا زنانه</a>
                <a class=" block" href="/گالری-طلا-بچگانه">طلا بچگانه</a>
                <a class=" block" href="/category/دستبند-طلا-مردانه">دستبند طلا مردانه</a>
                <a class=" block" href="/گردنبند-طلا-مردانه">گردنبند طلا مردانه</a>
            </div>
        </div>

        <div class="">
            <div class="font-bold border-b-2 border-[#ca8a04] inline-block mb-3 pl-20   ">خدمات مشتریان</div>
            <div>
                {{-- <div><a href="">راهنمای خرید</a></div>
                <div><a href="">راهنمایی تعیین سایز</a></div> --}}
                <div><a href="/تماس-با-ما">نحوه پیگیری سفارش</a></div>
                <div><a href="/مقالات">مجله ایدن</a></div>
                <a href="https://www.instagram.com/eden.gold.gallery/" target="_blank" rel="noopener">
                    <svg class="hover:fill-purple-900" width="20pt" height="20pt" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
    <div class="text-center text-sm border-t text-gray-400 border-gray-300 py-5 "> &copy; تمامی حقوق سایت متعلق به ایدن می باشد. ساخته شده توسط <a target="_blank" rel="noopener" href="https://dingweb.ir">دینگ وب</a></div>

</footer>

@stack('scripts')

@yield('footer')
@yield('cropper')

<script>
    if (screen && screen.width <= 768) {
        document.write('<script type="text/javascript" src="{{ url('/eden/pullToRefresh.umd.min.js') }}"><\/script>');

        setTimeout(() => {
            PullToRefresh.init({
                mainElement: 'body',
                onRefresh: function() {
                    location.reload();
                }
            });
        }, 500);
    }
</script>

{{-- <script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script> --}}
@if (WebsiteSetting::where('variable', '=', 'phone')->first())
    <a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton">phone</a>
@endif


<a href="https://api.whatsapp.com/send?phone=989374599840&text=سلام.%20میخواستم%20سفارش%20ثبت%20کنم"
    class="whatsappbutton" target="_blank">
    <i class="fab fa-whatsapp my-float"></i>
</a>

@if (url('/') == 'https://edengoldgallery.ir')
@endif
</body>

</html>
