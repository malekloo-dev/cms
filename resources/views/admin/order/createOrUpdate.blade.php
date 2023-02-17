@extends('admin.layouts.app')

@section('footer')
    <script src="/ckeditor4/ckeditor.js"></script>

    <script>
        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });

        $(document).ready(function() {
            CKEDITOR
                .replace(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                    },

                    @if (!$ltr)
                        language: 'fa'
                    @endif
                })
        });
    </script>
@endsection

@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active"><a href="{{ route('admin.company.index') }}">@lang('messages.companies')</a> </li>
            <li class="active">@lang('messages.add') </li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif


                <form
                    action="{{ Request()->is('*create*') ? route('admin.company.store') : route('admin.company.edit', $company->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @if (Request()->is('*edit*'))
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="row">
                        <div class="col-md-8  col-sm-8 form-group">
                            <div class="map-area">
                                <div id="mapid" style="min-height: 300px"></div>
                            </div>
                            <input class="form-control" name="location" type="hidden"
                                value="{{ old('location', $company->location ?? '') }}">
                        </div>
                        <div class="col-md-4 col-sm-4 form-group text-center">

                            @php
                                $attr_type = 'company';
                                $cropperPreview = url($company->logo['large'] ?? '');
                            @endphp
                            <style>
                                #cropperPreview,
                                #cropperPreviewPng {
                                    border-radius: 50%;
                                    width: 40%
                                }
                            </style>
                            @include('admin.cropper')

                            <input type="file" style="display: none" name="images" id="images">
                            <div style="cursor: pointer;" class="btn btn-info"
                                onclick="document.getElementById('images').click();">
                                @lang('messages.add') / @lang('messages.edit') @lang('messages.image')
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="name">@lang('messages.category'):</label>
                            <select id="parent_id" name="parent_id[]" multiple required>
                                @foreach ($category as $Key => $fields)
                                    <option value="{{ $fields['id'] }}"
                                        {{ $fields['id'] == $company->parent_id ? 'selected' : '' }}>
                                        {!! $fields['symbol'] . $fields['title'] !!}</option>
                                @endforeach
                            </select>

                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                        </div>
                        <div class="col-sm-6 col-md-6 form-group">

                            <label for="name">@lang('messages.main category'):</label>

                            <div id="parent_id_val" class="parent_id_val"></div>

                            <select id="parent_id_hide" name="parent_id_hide" required>
                                <option value="{!! $company->parent_id ?? '' !!}"></option>
                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.mobile'):
                            <input class="form-control" name="mobile" type="text"
                                value="{{ old('mobile', $company->mobile ?? '') }}" required>
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">
                            @lang('messages.store name'):
                            <input class="form-control" name="name" type="text"
                                value="{{ old('name', $company->name ?? '') }}" >
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">
                            @lang('messages.manager'):
                            <input class="form-control" name="manager" type="text"
                                value="{{ old('manager', $company->manager ?? '') }}">
                            <span class="text-danger">{{ $errors->first('manager') }}</span>

                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.sale manager'):
                            <input class="form-control" name="sale_manager" type="text"
                                value="{{ old('sale_manager', $company->sale_manager ?? '') }}">
                            <span class="text-danger">{{ $errors->first('sale_manager') }}</span>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.phone'):
                            <input id="phone" type="text" class="" name="phone"
                                value="{{ old('phone', $company->phone ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.site'):
                            <input class="form-control" name="site" type="text"
                                value="{{ old('site', $company->site ?? '') }}">
                            <span class="text-danger">{{ $errors->first('site') }}</span>
                        </div>


                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.email'):
                            <input class="form-control" name="email" type="text"
                                value="{{ old('email', $company->email ?? '') }}">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.address'):
                            <input class="form-control" name="address" type="text"
                                value="{{ old('address', $company->address ?? '') }}">
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.city'):
                            <input class="form-control" name="city" type="text"
                                value="{{ old('city', $company->city ?? '') }}">
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.province'):
                            <input class="form-control" name="province" type="text"
                                value="{{ old('province', $company->province ?? '') }}">
                            <span class="text-danger">{{ $errors->first('province') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.whatsapp'):
                            <input class="form-control" name="whatsapp" type="text"
                                value="{{ old('whatsapp', $company->whatsapp ?? '') }}">
                            <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.telegram'):
                            <input class="form-control" name="telegram" type="text"
                                value="{{ old('telegram', $company->telegram ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.instagram'):
                            <input class="form-control" name="instagram" type="text"
                                value="{{ old('instagram', $company->instagram ?? '') }}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-6">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title"
                                value="{{ old('meta_title', $company->meta_title ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <label for="name" class=" text-md-left">meta keywords</label>
                            <input id="meta_keywords" type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $company->meta_keywords ?? '') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="meta_description" class=" col-form-label text-md-left">meta
                                Description:</label>
                            <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $company->meta_description ?? '') }}</textarea>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6 col-md-6">
                            <label for="name" class="col-form-label text-md-left">@lang('messages.status'):</label>

                            <select class="form-control" name="status">
                                <option value="1" {{ ($company->status ?? '1') == '1' ? 'selected' : '' }}>
                                    @lang('messages.Active')</option>
                                <option value="0" {{ ($company->status ?? '') == '0' ? 'selected' : '' }}>
                                    @lang('messages.Disactive')</option>
                            </select>
                        </div>

                    </div>




                    <div class="row">
                        <div class="col-md-12  col-sm-12 form-group">@lang('messages.description'):
                            <textarea id="description" name="description" class="form-control" cols="30" rows="10">{{ old('description', $company->description ?? '') }}</textarea>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <button type="submit"
                                class="btn btn-success  @if (!$ltr) pull-right @endif mat-btn ">

                                @if (Request()->is('*create*'))
                                    @lang('messages.add')
                                @else
                                    @lang('messages.edit')
                                @endif
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="anonymous" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>


    <script>
        $(document).ready(function() {
            var $input = $("#parent_id");
            var $parent_id_hide = $("#parent_id_hide");
            var $parent = $('#parent_id_hide').find(':selected').val();

            $input.on("selecting unselecting change", function() {
                setOption($("#parent_id").parent().find("ul.select2-choices"));

            })
            $parent_id_hide.on("selecting unselecting change", function() {
                $parent = $('#parent_id_hide').find(':selected').val();

            })

            $("#parent_id").parent().find("ul.select2-choices").sortable({
                containment: 'parent',
                update: function() {
                    setOption(this)
                },
            });
            @isset($company)
                @php
                    $categoryImplode = "'" . implode("','", $company->categories->pluck('id')->toArray()) . "'";

                @endphp
            @endisset

            $input.val([{!! $categoryImplode ?? '' !!}]);

            $input.trigger('change'); // Notify any JS components that the value changed

            function setOption($this) {
                var $select = $("#parent_id");
                //$(this).closest(".select2-container").next();
                var options;
                options = $select.find("option");
                //$("#parent_id_hide").empty();
                //var newoptions = '';
                var newoptions = [];
                // Clear option
                $($this).find(".select2-search-choice").each(function(i, tag) {

                    var $exist = 0;
                    options.each(function(j, option) {
                        var optionTag = '';
                        if ($.trim($(tag).text()) == $.trim($(option).text())) {
                            // console.log(option.val());
                            //$("#par_idd").append(new Option($(tag).text(),  $(option).val()));
                            optionTag = new Option($(tag).text(), $(option).val());
                            if ($(option).val() == $parent) {
                                $exist = 1;
                            }
                            $("#par_idd").append(new Option($(tag).text(), $(option).val()));
                            //newoptions=newoptions+','+$(option).val();
                            newoptions.push(optionTag);
                            //$("#par_idd").append(option);
                        }

                    });
                });


                //$parent = $('#parent_id_hide').find(':selected').val();

                $("#parent_id_hide").empty();
                //$('#parent_id_hide option:selected').removeAttr('selected');
                $('#parent_id_hide').select2('destroy');
                $parent_id_hide.select2();
                if (newoptions.length > 0) {
                    $("#parent_id_hide").append(newoptions);
                    $parent_id_hide.val($parent);
                }
                // $parent_id_hide.val($parent);

                //$('#parent_id_hide').select2('destroy');

                //if ($exist != 0) {
                // }
                $parent_id_hide.trigger('change'); // Notify any JS components that the value changed


                //getselector();


            };
        });
    </script>

    <script>
        $("#parent_id").select2();
        $("#parent_id_hide").select2();
        $("#phone").select2({
            tags: [],
            maximumInputLength: 100
        });
    </script>





    <script>
        var map = L.map('mapid')
            .setView([{{ $company->location ?? '35.65,51.4' }}], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
            // zoomOffset: -1
            // maxZoom: 18,
            // tileSize: 512
        }).addTo(map);


        //marker
        var marker = L.marker([{{ $company->location ?? '35.65,51.4' }}])
            .addTo(map);
        // .bindPopup(`@lang('messages.my location')`)
        // .openPopup();
        marker.dragging.enable();
        $('input[name=location]').val(marker.getLatLng().lat + ',' + marker.getLatLng().lng);
        //meghyas
        L.control.scale().addTo(map);

        //scroll disable zoom
        map.scrollWheelZoom.enable();



        // $('body').on('click', '.map-editor button.edit', function() {
        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         url: "{{ route('company.profile.update') }}",
        //         data: {
        //             '_token': $('meta[name="_token"]').attr('content'),
        //             'data': [{
        //                 'name': 'location',
        //                 'value': marker.getLatLng().lat + ',' + marker.getLatLng().lng
        //             }]
        //         },
        //         success: function(data) {
        //             marker.dragging.disable();
        //             map.scrollWheelZoom.disable();

        //             $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
        //             $('.map-area').toggleClass('map-editor');
        //         }
        //     });
        // });



        // $('body').on('click', '.map-editor a.cancel', function() {
        //     marker.dragging.disable();
        //     map.scrollWheelZoom.disable();
        //     $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
        //     $('.map-area').toggleClass('map-editor');
        // });



        function onMapClick(e) {

            marker.setLatLng(e.latlng);
            map.panTo(e.latlng);

            // map.addLayer(marker);

            $('input[name=location]').val(marker.getLatLng().lat + ',' + marker.getLatLng().lng);
        };

        marker.on('dragend', function(event) {
            var marker = event.target;
            var position = marker.getLatLng();

            marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                draggable: 'true'
            });

            map.panTo(new L.LatLng(position.lat, position.lng));
            $('input[name=location]').val(marker.getLatLng().lat + ',' + marker.getLatLng().lng);

        });
        map.on('click', onMapClick);
    </script>
@endsection
