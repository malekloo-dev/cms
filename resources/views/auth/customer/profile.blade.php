@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.profile'))

@section('Content')

    <section class="panel ">
        @include('auth.customer.nav')

        <div class="profile">
            <h1 class="full">@lang('messages.profile')</h1>

            <div class="flex six-500 center" style="gap:0 4em">
                <div class=" one">
                    <div class="text-center company-logo">

                        @if (!isset(Auth::user()->company->logo['large']) || Auth::user()->company->logo['large'] == '' || !file_exists(public_path(Auth::user()->company->logo['large'] )))
                            <i class="far fa-user logo" style="font-size:4em"></i>
                            <img src="" width="0" height="0" class="border-radius-50 p-0" alt="">
                        @else
                            <img width="100" height="100" class="border-radius-50 p-0"  src="{{ url(Auth::user()->company->logo['large']) }}?{{ uniqid() }}">
                        @endif
                    </div>
                    <div style="cursor: pointer" class="btn btn-warning" onclick="document.getElementById('images').click();">


                        @lang('messages.edit') @lang('messages.image')

                        <input type="file" style="display:none" name="images" id="images">

                        <i class="far fa-edit color-inherit "></i>
                    </div>
                </div>
                <div class="full two-third-500">
                    <div class="map-area">
                        <div id="mapid"></div>
                    </div>
                    <div style="cursor: pointer" class="location-editor btn btn-warning block">
                        @lang('messages.edit') @lang('messages.my location')
                        <i class="far fa-edit color-inherit"></i>
                    </div>
                </div>
            </div>

            <div class="flex one two-700 three-1100 mt-2">


                <div class="bg-orange-light full py-1 mb-1 border-radius-5">
                    برای ویرایش هر آیتم روی علامت <i class="fa-edit far fa-edit color-inherit"></i> بزنید.
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
                    <span class="text-editor" data-field="phone" data-label="شماره تلفن را با , از هم جدا کنید" style="display: inline-block">{{ $user->company?->phone ?? '' }}</span>
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

                <div class="">@lang('messages.status'): <span>{{ ($user->customer?->status == 0)?'غیر فعال':'فعال' }}</span></div>

            </div>


        </div>

    </section>

@endsection

@section('cropper')

    @include('auth.company.cropper')

@endsection


@section('footer')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="anonymous" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
        $.each($('.profile .text-editor'), function(i, n) {
            $(this).append(
                '<i class="fa-edit far fa-edit color-inherit"></i>'
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
                            '<i class="fa-edit far fa-edit color-inherit"></i>'
                        )
                    }
                });
            });

            $('#edit-profile .close').on('click', function() {
                $('#edit-profile').modal('hide');
            })
        });

    </script>










    <script>
        var map = L.map('mapid')
            .setView([{{ Auth::user()->company->location ?? '35.7,51.4' }}], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
            // zoomOffset: -1
            // maxZoom: 18,
            // tileSize: 512
        }).addTo(map);


        //marker
        var marker = L.marker([{{ Auth::user()->company->location ?? '35.7,51.4' }}])
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

            $('.map-area').append('<div class="guid">@lang("messages.map edit guid")</div>');

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

                    $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
                    $('.map-area').toggleClass('map-editor');
                }
            });
        });



        $('body').on('click', '.map-editor a.cancel', function() {
            marker.dragging.disable();
            map.scrollWheelZoom.disable();
            $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
            $('.map-area').toggleClass('map-editor');
        });



        function onMapClick(e) {

            if ($(".map-area").hasClass("map-editor")) {
                marker.setLatLng(e.latlng);
                map.panTo(e.latlng);
            }

            marker.on('dragend', function(event) {
                var marker = event.target;
                var position = marker.getLatLng();
                marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                    draggable: 'true'
                });
                map.panTo(new L.LatLng(position.lat, position.lng))
            });
            map.addLayer(marker);
        };

        map.on('click', onMapClick);

    </script>

    <div class="modal fade profile-editor-modal" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <h3>@lang('messages.edit')</h3>
                            <form>
                                <div class="col-xs-12 py-1 ">
                                    <div class="col-md-12 col-xs-12">
                                        <label for=""></label>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <input type="text" name="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{-- <input type="submit" class="btn btn-info" value="@lang('messages.edit')"> --}}
                                    <button class="btn btn-success">@lang('messages.edit')</button>
                                    <a class="btn red close" href="#">@lang('messages.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
