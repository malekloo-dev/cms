<section class="" id="footer">
    <div class="flex">
        <div class="flex grow one pt-1 ">

            <div class="half-500 flex mt-0 ml-0 pl-0 ">

                <a href="/بلاگ">بلاگ</a>
                <a href="/درباره-ما">درباره ما</a>
                <a href="/تماس-با-ما">تماس با ما</a>
                <a href="/تعرفه-تبلیغات">تعرفه تبلیغات</a>

            </div>

            <div class="half-500 text-left">
                <div>ویژن شرکت ریموت یدک</div>
                <div>
                    ایجاد پلتفرم تبلیغاتی و مشاوره در زمینه ساخت سوئیچ و ریموت
                </div>
                <div>ساخته شده توسط <a target="_blanck" href="https://tarhoweb.com">طرح و وب</a></div>
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
