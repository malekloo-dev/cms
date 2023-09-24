<section class="footer-links m-0 " id="footer">
    <div class="container">
        <div class="flex ">

            <div class="md:w-1/6">
                <div> تماس با ما</div>
                <div class="">
                    پاساژ امجد طبقه ۳ پلاک۱۶ فروشگاه عصر آی تی <br>
                    021-66740231-2 <br>
                    66740447 – 66740172 <br>
                    09128210151
                </div>
            </div>

            <div class="md:w-2/6">
                <div>درباره ما</div>
                <div class="flex pl-1">
                    عصر آی تی با سال ها تجربه در زمینه واردات و تولید کالاهای الکترونیکی از جمله سیم ، کابل ، رابط و
                    تبدیل می باشد. این فروشگاه در پاساژ امجد مشغول به فعالیت بوده و عرضه کننده مستقیم و بدون واسط
                    کالای الکترونیکی به خریدار می باشد.


                </div>
            </div>

            <div class="md:w-1/6 w-1/3">
                <div>محصولات ما:</div>
                <ul>
                    <li><a href="/سیم-نسوز">سیم نسوز </a></li>
                    <li><a href="/سیم-سیلیکونی">سیم سیلیکونی </a></li>
                </ul>
            </div>

            <div class="md:w-1/6 w-1/3">
                <ul>
                    <li><a href="/کابل-کواکسیال">کابل کواکسیال </a></li>
                    <li><a href="/کابل-فلت">کابل فلت </a></li>
                    <li><a href="/کابل-رابط">کابل رابط </a></li>
                    <li><a href="/کابل-فیبر-نوری">کابل فیبر نوری </a></li>
                </ul>
            </div>

            <div class="md:w-1/6 w-1/3">
                <ul>
                    <li><a href="/کانکتور-کواکسیال">کانکتور کواکسیال  </a></li>
                    <li><a href="/کانکتور-برق">کانکتور برق  </a></li>
                    <li><a href="/کانکتور-شبکه">کانکتور شبکه</a></li>
                </ul>
            </div>


        </div>
    </div>
</section>
<section class="footer-copyright mt-0">
    <div class="container">
        <div class="flex one">
            <div class="text-center">
                <div>
                    این وب سایت متعلق به فروشگاه عصر آی تی می باشد.

                    ساخته شده توسط <a target="_blanck" href="https://tarhoweb.com">طرح و وب</a></div>
            </div>
        </div>
    </div>
</section>



@stack('scripts')

@yield('footer')
@yield('cropper')

<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
{{-- <script src="{{ url('/main.js') }}"></script> --}}
@if (WebsiteSetting::where('variable', '=', 'phone')->first()?->value != '' )
<a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton"></a>
@endif
</body>

</html>
