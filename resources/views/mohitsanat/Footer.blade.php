<section class="wide" id="footer">
    <div class="container">

        <div>
            <div>کدپستی : 1686614736</div>
            <div>ایمیل: info@mohitsanat.ir</div>
            <div>تماس :02177082194 - فکس : 02177082195</div>
            <div>آدرس : تهران ، تهرانپارس ، خیابان سراج، بالاتر از بلوار دلاوران، جنب بانک سپه، پلاک 171، طبقه 2 ، واحد 7</div>
        </div>


        <div class="social-network">

            <a href="https://www.instagram.com/mohitsanat/" target="_blank">


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
            <a href="https://www.linkedin.com/in/%D9%85%D8%AD%DB%8C%D8%B7-%D9%88-%D8%B5%D9%86%D8%B9%D8%AA-%D8%A7%DB%8C%D9%85%D9%86-%D9%BE%D8%A7%DB%8C%D8%B4-%D8%A2%D8%B2%D9%85%D8%A7%DB%8C%D8%B4%DA%AF%D8%A7%D9%87-%D9%85%D8%B9%D8%AA%D9%85%D8%AF-%D9%85%D8%AD%DB%8C%D8%B7-%D8%B2%DB%8C%D8%B3%D8%AA-330317200/" target="_blank">
                <svg  viewBox="0 0 512 512" width="32pt" height="32pt" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="m160.007812 423h-70v-226h70zm6.984376-298.003906c0-22.628906-18.359376-40.996094-40.976563-40.996094-22.703125 0-41.015625 18.367188-41.015625 40.996094 0 22.636718 18.3125 41.003906 41.015625 41.003906 22.617187 0 40.976563-18.367188 40.976563-41.003906zm255.007812 173.667968c0-60.667968-12.816406-105.664062-83.6875-105.664062-34.054688 0-56.914062 17.03125-66.246094 34.742188h-.066406v-30.742188h-68v226h68v-112.210938c0-29.386718 7.480469-57.855468 43.90625-57.855468 35.929688 0 37.09375 33.605468 37.09375 59.722656v110.34375h69zm90 153.335938v-392c0-33.085938-26.914062-60-60-60h-392c-33.085938 0-60 26.914062-60 60v392c0 33.085938 26.914062 60 60 60h392c33.085938 0 60-26.914062 60-60zm-60-412c11.027344 0 20 8.972656 20 20v392c0 11.027344-8.972656 20-20 20h-392c-11.027344 0-20-8.972656-20-20v-392c0-11.027344 8.972656-20 20-20zm0 0" />
                    </g>
                </svg>
            </a>
        </div>
        <div class="flex grow one text-center">
            <div> شرکت محیط صنعت .
                ساخته شده توسط <a target="_blank" href="https://tarhoweb.com">طرح و وب</a></div>
        </div>
    </div>
</section>

@yield('footer')
@yield('cropper')
{{-- <script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script> --}}
@if (WebsiteSetting::where('variable','=','phone')->first())
    <a href="tel:{{  WebsiteSetting::where('variable','=','phone')->first()->value }}" id="callnowbutton"></a>
@endif

</body>

</html>