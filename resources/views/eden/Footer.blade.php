<footer class="wide" id="footer">
    <div>
        <div class="flex  three four-500 six-900 font-09 text-center pt-1 center">
            <a class="color-gray" href="/محصولات">تمامی محصولات</a>
            <a class="color-gray" href="/درباره-ما">درباره ما</a>
            <a class="color-gray" href="/تماس-با-ما">تماس با ما</a>
        </div>
    </div>
    <div class="container">



        <div class="social-network m-auto">

            <a href="https://www.instagram.com/eden.gold.gallery/" target="_blank" rel="noopener">


                <svg width="32pt" height="32pt" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
        <div class="flex grow one text-center">
            <div> فروش طلا بدون واسطه به قیمت بازار.
                ساخته شده توسط <a target="_blank" rel="noopener" href="https://tarhoweb.com">طرح و وب</a></div>
        </div>
    </div>
</footer>



@stack('scripts')

@yield('footer')
@yield('cropper')

<script>
    if(screen && screen.width <= 768){
        document.write('<script type="text/javascript" src="{{ url("/eden/pullToRefresh.umd.min.js") }}"><\/script>');

        setTimeout(() => {
            PullToRefresh.init({
                    mainElement: 'body',
                    onRefresh: function() { location.reload(); }
                });
        }, 500);


    }
</script>

{{-- <script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script> --}}
@if (WebsiteSetting::where('variable', '=', 'phone')->first())
    <a  href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton">phone</a>
@endif




<a href="https://api.whatsapp.com/send?phone=989374599840&text=سلام.%20میخواستم%20سفارش%20ثبت%20کنم" class="whatsappbutton" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
</body>

</html>
