@include('admin.head')

    @include('admin.nav')
    @include('admin.header')


        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 center-block">
                    @yield('content')
                </div>
            </div>
        </div>





@include('admin.footer')
