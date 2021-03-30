<section class="wide" id="footer">
    <div class="container">
        <div class="flex grow one ">

            <div class="half">
                <div>ویژن شرکت ریموت یدک</div>
                <div>
                    ایجاد پلتفرم تبلیغاتی و مشاوره در زمینه ساخت سوئیچ و ریموت
                </div>
                <div>ساخته شده توسط <a target="_blanck" href="https://tarhoweb.com">طرح و وب</a></div>
            </div>
        </div>
    </div>
</section>
@yield('footer')
@yield('cropper')

<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script>
</body>
</html>
