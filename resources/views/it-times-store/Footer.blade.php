<section class="footer-links m-0 " id="footer">
    <div class="container">
        <div class="flex one three-500">

            <div class="">
                <div> تماس با ما</div>
                <div class="">
                    پاساژ امجد طبقه ۳ پلاک۱۶ فروشگاه عصر آی تی <br>
                    021-66740231-2 <br>
                    66740447 – 66740172 <br>
                    09122986181
                </div>
            </div>

            <div class="">
                <div>درباره ما</div>
                <div class="flex one ">
                    عصر آی تی با سال ها تجربه در زمینه واردات و تولید کالاهای الکترونیکی از جمله سیم ، کابل ، رابط و
                    تبدیل می باشد. این فروشگاه در پاساژ امجد مشغول به فعالیت بوده و عرضه کننده مستقیم و بدون واسط
                    کالای الکترونیکی به خریدار می باشد.


                </div>
            </div>

            <div class="">
                <div>محصولات ما</div>
                <ul>
                    <li><a href="/سیم-برق">سیم برق</a></li>
                    <li><a href="/کابل">کابل ها</a></li>
                    <li><a href="/کانکتور-و-تبدیل">کانکتور و تبدیل</a></li>
                    <li><a href="/تجهیزات-الکترونیک">تجهیزات الکترونیک</a></li>
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
@if (WebsiteSetting::where('variable', '=', 'phone')->first())
    <a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first() }}" id="callnowbutton"></a>
@endif
</body>

</html>
