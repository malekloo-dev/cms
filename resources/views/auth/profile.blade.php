@extends(@env('TEMPLATE_NAME').'.App')
@section('map')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="anonymous" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

@endsection
@section('Content')

    <section class="panel ">
        @include('auth.nav')

        <div class="profile">
            <h1 class="full">@lang('messages.profile')</h1>
            <div class="map-area">
                <div id="mapid"></div>
            </div>
            <div class="flex one two-700 three-1100 mt-2">
                <div style="cursor: pointer" class="" onclick="document.getElementById('images').click();">
                    @lang('messages.edit') @lang('messages.image')

                    <img style="padding:0 0.5em"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAACCUlEQVQ4jdXUPWiTQRgH8P9zqYhuGWIlie4dtA7SpULRRbr5iYIVpLz33tvBIYvoIJ74tfqxJHchYBXUIuLg5uTg1ClDFIQuQkLaJYPE6c37d9CEt5qG103/2/Pc3e/uWQ741yPpIgiCci6XOw1gb8bz30XkTbVabf8BBkFQVko1AXQBdDKCRQDTSqnZITo1kkXOAtgsFouHrLVJFs1aqzqdTmswGJwD8AgAVArMk9ychAVBMBOG4T1jzBIAsdYmJLsikh/uUTsd/j2VSmWPUuqDiJwk6Ywxl8ftywz2+/0CgALJWwBaJGf+CgyC4HAURfuGtXPuK4BXAN4BOJAkyWom0Fo7pbV+qpRqJkmyobVeTKEXlVLlXq93sF6vf84C7mq32y9EZJHkHMmHIvI2DMNTAKC1PjIYDK7m8/n5nSbbBorIvIgcI3nce7/uvb9J0gJYM8bcF5GPInICwHut9XKWF26RXPDet4YN7/0DAM9I3iD5xDk3R3JFRFwYhisTQZKfvPdf0j1jzBkASwBue++v/7rEi8gygMcicnTSC7fFGHOB5EsAd51zNr1Wq9VWSV4CsHssSLInItPWWgUAWusrJJ8DuOacuzPuwlKp9BrABsnesDf6HKIoKiVJ0gSwhZ8fxAKAbwDWJwxRAlCI43i20Wh0toEp9DzJ/ROQUUSkG8fx2hD7P/IDjnbjmjZON9wAAAAASUVORK5CYII=">
                </div>

                <div style="cursor: pointer" class="location-editor">
                    @lang('messages.edit') @lang('messages.my location')

                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172"
                        style=" fill:#000000;">
                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                            font-family="none" font-weight="none" font-size="none" text-anchor="none"
                            style="mix-blend-mode: normal">
                            <path d="M0,172v-172h172v172z" fill="none"></path>
                            <g fill="#666666">
                                <path
                                    d="M86,7.16667c-23.75033,0 -43,19.24967 -43,43c0,30.71633 43,78.83333 43,78.83333c0,0 43,-48.117 43,-78.83333c0,-23.75033 -19.24967,-43 -43,-43zM86,34.81152c8.48533,0 15.35514,6.86981 15.35514,15.35514c0,8.47817 -6.87698,15.35514 -15.35514,15.35514c-8.47817,0 -15.35514,-6.86981 -15.35514,-15.35514c0,-8.48533 6.86981,-15.35514 15.35514,-15.35514zM34.4056,107.5l-20.07227,50.16667h143.33333l-20.07226,-50.16667h-17.10482c-3.47583,5.23883 -6.96544,10.09067 -10.17611,14.33333h17.59473l8.5944,21.5h-101.00521l8.5944,-21.5h17.59473c-3.21067,-4.24267 -6.70027,-9.0945 -10.17611,-14.33333z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>

                <div class="">
                    @lang('messages.store name'):
                    <span class="text-editor" data-field='name'
                        data-label="@lang('messages.store name')">{{ $user->company->name ?? '' }}</span>
                </div>
                <div class=" ">
                    @lang('messages.name'):
                    <span class="text-editor" data-field="manager"
                        data-label="@lang('messages.name')">{{ $user->company->manager ?? '' }}</span>
                </div>
                <div class="">@lang('messages.sale manager'):
                    <span class="text-editor" data-field="sale_manager"
                        data-label="@lang('messages.sale manager')">{{ $user->company->sale_manager ?? '' }}</span>
                </div>
                <div class="">@lang('messages.mobile'):
                    <span class="text-editor" data-field="mobile"
                        data-label="@lang('messages.mobile')">{{ $user->company->mobile ?? '' }}</span>
                </div>
                <div class="">@lang('messages.phone'):
                    <span class="ltr">
                        @isset($user->company->phone)
                            @foreach ($user->company->phone as $item)
                                {{ $item }}
                                @if (!$loop->last)
                                    -
                                @endif
                            @endforeach
                        @endisset
                    </span>
                </div>
                <div class="">@lang('messages.site'):
                    <span class="text-editor" data-field="site"
                        data-label="@lang('messages.site')">{{ $user->company->site ?? '' }}</span>
                </div>

                <div class="">@lang('messages.email'): <span class="text-editor" data-field="email"
                        data-label="@lang('messages.email')">{{ $user->company->email ?? '' }}</span>
                </div>

                <div class="">@lang('messages.address'): <span class="text-editor" data-field="address"
                        data-label="@lang('messages.address')">{{ $user->company->address ?? '' }}</span></div>

                <div class="">@lang('messages.city'): <span class="text-editor" data-field="city"
                        data-label="@lang('messages.city')">{{ $user->company->city ?? '' }}</span>
                </div>

                <div class="">@lang('messages.province'): <span class="text-editor" data-field="province"
                        data-label="@lang('messages.province')">{{ $user->company->province ?? '' }}</span></div>

                <div class="">@lang('messages.whatsapp'): <span class="ltr text-editor" data-field="whatsapp"
                        data-label="@lang('messages.whatsapp')">{{ $user->company->whatsapp ?? '' }}</span>
                </div>

                <div class="">@lang('messages.telegram'): <span class="text-editor" data-field="telegram"
                        data-label="@lang('messages.telegram')">{{ $user->company->telegram ?? '' }}</span></div>

                <div class="">@lang('messages.instagram'): <span class="text-editor" data-field="instagram"
                        data-label="@lang('messages.instagram')">{{ $user->company->instagram ?? '' }}</span></div>

                <div class="">@lang('messages.register date'): <span>{{ convertGToJ($user->date) }}</span></div>

            </div>


        </div>

    </section>

@endsection


@section('footer')


    <script>
        $.each($('.profile .text-editor'), function(i, n) {
            $(this).append(
                '<img class="fa-edit" style="padding:0 0.5em" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAACxUlEQVQ4jZ3ST2hcVRTH8e959735E0V3rmwpuOomWUygCsGW2IYxUxcWkjShxYCTl1WQoRtxlYUoqBsZSe1tUsVgF01L/0hc1WZqqOgipNiAq64KWbhIUmn+jPPuPd3Ma0NMTNKzutzD+fA7lyu8WEkcx58AReCytfZ82jAvog0NDb0vIheAg0Cpvb09mJubq+0brFQq+ba2tq+iKJr03kfAW83W0RTdF9ja2toLfOG974qiaMh7nwHeTNFCofD3nsCenp5MR0fHl0EQ/KCqS8CZJlr23ueAIwCq+tKu4MjISDaTyVwDBoCatfb7QqFQ34R+6JzLi8gREflGdsPq9fo1oEtV+7z3D4Ig+FpEPgDKwOfA/SiKjjcajU5r7dUdEw4ODuaA68AJoNd7v2CMmRGRAvCqtfbjNKmqvmat/Qwg3AnLZDLXgU6gF3hgjKkBrwN319fXzw0PD/eLyCXn3KNsNvtTOvuflSuVSn51dfUGcExEelV1AZgBDjSxUj6fPwOcB3601p7dPB9sg90CjgF9SZLcB24DB0RkNgzDky0tLaeBMWDeOffR1kDPEsZx3ALcBN4G+pxz8801D4nIrDGm2znXp6pWROaTJOmamJhY2goGAKOjo2GKqWqPMeZPY8yvwCFgRlWLjUajX1Ut8IeqvrMd9gxcXFzsBI6rajkMwwXn3AxwUETuACeBARH5Fvg9m80WrbWPt8M2v2EJeJLL5a547weAV4BfVPU9EekHLgC/JUlSrFar/+yEwfNvUwJuV6vVOvBpHMfLwHeqehqwInLPGNNtrX3yfxhAUC6XDwNvqOrP6eXy8vJFVR0UkYvA7Nra2rtjY2O7YgChiJQARKQYx7GKSLeqngBeVtV7GxsbpcnJydW9YOnKpeb5FHBKVR8Cl4DplZWV2tTU1L97xdKES6paA6ZVdXp8fPyv/QBb6ylonDPZbLKXSwAAAABJRU5ErkJggg==">'
            )
        });

        $('.profile .text-editor').click(function() {

            $('.profile-editor-modal input[type=text]').attr('name', '');
            $('.profile-editor-modal label').html('');
            var field = $(this).data('field');
            var label = $(this).data('label');
            var val = $(this).text();
            $('#edit-profile').modal('show');
            $('.profile-editor-modal input[type=text]').attr('name', field);
            if (['email', 'mobile', 'site', 'whatsapp', 'telegram', 'instagram'].includes(field)) {
                $('.profile-editor-modal input[type=text]').css('direction', 'ltr');
            } else {
                $('.profile-editor-modal input[type=text]').css('direction', 'rtl');
            }
            $('.profile-editor-modal input[type=text]').val(val);
            $('.profile-editor-modal label').html(label);

        });

        $(function() {

            $('#edit-profile form').submit(function(e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('company.profile.update') }}",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'data': $('#edit-profile form').serializeArray()
                    },
                    success: function(data) {
                        $('#edit-profile').modal('hide');
                        $('span[data-field=' + data.data.name + ']').text(data.data.value);
                        $('span[data-field=' + data.data.name + ']').append(
                            '<img class="fa-edit" style="padding:0 0.5em" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAACxUlEQVQ4jZ3ST2hcVRTH8e959735E0V3rmwpuOomWUygCsGW2IYxUxcWkjShxYCTl1WQoRtxlYUoqBsZSe1tUsVgF01L/0hc1WZqqOgipNiAq64KWbhIUmn+jPPuPd3Ma0NMTNKzutzD+fA7lyu8WEkcx58AReCytfZ82jAvog0NDb0vIheAg0Cpvb09mJubq+0brFQq+ba2tq+iKJr03kfAW83W0RTdF9ja2toLfOG974qiaMh7nwHeTNFCofD3nsCenp5MR0fHl0EQ/KCqS8CZJlr23ueAIwCq+tKu4MjISDaTyVwDBoCatfb7QqFQ34R+6JzLi8gREflGdsPq9fo1oEtV+7z3D4Ig+FpEPgDKwOfA/SiKjjcajU5r7dUdEw4ODuaA68AJoNd7v2CMmRGRAvCqtfbjNKmqvmat/Qwg3AnLZDLXgU6gF3hgjKkBrwN319fXzw0PD/eLyCXn3KNsNvtTOvuflSuVSn51dfUGcExEelV1AZgBDjSxUj6fPwOcB3601p7dPB9sg90CjgF9SZLcB24DB0RkNgzDky0tLaeBMWDeOffR1kDPEsZx3ALcBN4G+pxz8801D4nIrDGm2znXp6pWROaTJOmamJhY2goGAKOjo2GKqWqPMeZPY8yvwCFgRlWLjUajX1Ut8IeqvrMd9gxcXFzsBI6rajkMwwXn3AxwUETuACeBARH5Fvg9m80WrbWPt8M2v2EJeJLL5a547weAV4BfVPU9EekHLgC/JUlSrFar/+yEwfNvUwJuV6vVOvBpHMfLwHeqehqwInLPGNNtrX3yfxhAUC6XDwNvqOrP6eXy8vJFVR0UkYvA7Nra2rtjY2O7YgChiJQARKQYx7GKSLeqngBeVtV7GxsbpcnJydW9YOnKpeb5FHBKVR8Cl4DplZWV2tTU1L97xdKES6paA6ZVdXp8fPyv/QBb6ylonDPZbLKXSwAAAABJRU5ErkJggg==">'
                        )
                    }
                });
            });

            $('#edit-profile .close').on('click', function() {
                $('#edit-profile').modal('hide');
            })
        });

    </script>

    @if (Auth::user()->company->location != '')


        <script>
            var map = L.map('mapid')
                .setView([{{ Auth::user()->company->location }}], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
                // zoomOffset: -1
                // maxZoom: 18,
                // tileSize: 512
            }).addTo(map);


            //marker
            var marker = L.marker([{{ Auth::user()->company->location }}])
                .addTo(map)
                .bindPopup(`@lang('messages.my location')`)
                .openPopup();

            //access location
            map.locate({
                setView: true,
                maxZoom: 16
            });

            //meghyas
            L.control.scale().addTo(map);

            //scroll disable zoom
            map.scrollWheelZoom.disable();



            //change pin locate
            $('.location-editor').click(function() {
                marker.dragging.enable();
                map.scrollWheelZoom.enable();


                $('.map-area').toggleClass('map-editor');

                $('.map-area').append('<button class="btn btn-info edit">@lang("messages.edit")</button>' +
                    '<a class="btn cancel">@lang("messages.cancel")</a>');

            });

            $('body').on('click', '.map-editor button.edit', function() {



                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('company.profile.update') }}",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'data': [{
                            'name': 'location',
                            'value': marker.getLatLng().lat + ',' + marker.getLatLng().lng
                        }]
                    },
                    success: function(data) {
                        marker.dragging.disable();
                        map.scrollWheelZoom.disable();

                        $('.map-area .edit,.map-area .cancel').remove();
                        $('.map-area').toggleClass('map-editor');
                    }
                });
            });

            $('body').on('click', '.map-editor a.cancel', function() {
                marker.dragging.disable();
                map.scrollWheelZoom.disable();

                $('.map-area .edit,.map-area .cancel').remove();
                $('.map-area').toggleClass('map-editor');

            });


            // function onLocationFound(e) {
            //     var marker = L.marker([e.latlng.lat, e.latlng.lng]).update(marker);

            //     // alert('New latitude is ' + e.latlng.lat)

            //     map.setView([e.latlng.lat, e.latlng.lng], 16);


            // }

            // map.on('locationfound', onLocationFound);

        </script>
    @endisset
    <div class="modal fade profile-editor-modal" id="edit-profile" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <form>
                                <div class="col-md-12 py-1 ">
                                    <label for=""></label>
                                    <input type="text" name="">
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value="@lang('messages.edit')">
                                    <a class="btn close" href="#">@lang('messages.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
