@include(@env('TEMPLATE_NAME').'.Head')
@include(@env('TEMPLATE_NAME').'.Nav')
@yield('Content')
@include(@env('TEMPLATE_NAME').'.Footer')
