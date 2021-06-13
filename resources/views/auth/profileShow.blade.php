@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="profile-show">
        <div class="flex shadow">
            <h1 class="full">{{ $company->name ?? '' }}</h1>
            <div class="map-area" style="display: block; width: 100%">
                <div id="mapid" style="width: 100%; height: 200px;"></div>
            </div>
            <div class="flex one five-700  ">
                <div class="one">
                    @if (!isset($company->logo['large']) || $company->logo['large'] == '' || !file_exists(public_path($company->logo['large'])))
                        <svg id="bold" enable-background="new 0 0 24 24" height="100" viewBox="0 0 24 24" width="100"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m19 19.5v-5c0-1.654 1.346-3 3-3 .552 0 1 .448 1 1 0 .556-.454 1.007-1.012 1-.548-.007-.988.452-.988 1v3c0 1.105-.895 2-2 2z" />
                            <path
                                d="m5 19.5v-5c0-1.654-1.346-3-3-3-.552 0-1 .448-1 1 0 .556.454 1.007 1.012 1 .548-.007.988.452.988 1v3c0 1.105.895 2 2 2z" />
                            <path d="m16.25 24h-8.5c-.552 0-1-.448-1-1s.448-1 1-1h8.5c.552 0 1 .448 1 1s-.448 1-1 1z" />
                            <path d="m12 24c-.552 0-1-.448-1-1v-4.25c0-.552.448-1 1-1s1 .448 1 1v4.25c0 .552-.448 1-1 1z" />
                            <path
                                d="m17.061 13h-10.122c-.518 0-1.006-.228-1.339-.624-.334-.396-.474-.916-.385-1.426l1.652-9.5c.146-.84.871-1.45 1.724-1.45h6.817c.854 0 1.579.61 1.724 1.451l1.652 9.5c.089.51-.051 1.03-.385 1.426-.332.395-.82.623-1.338.623z" />
                            <path
                                d="m19.25 19.5h-14.5c-.414 0-.75-.336-.75-.75v-2c0-1.517 1.233-2.75 2.75-2.75h10.5c1.517 0 2.75 1.233 2.75 2.75v2c0 .414-.336.75-.75.75z" />
                        </svg>
                    @else
                        <img class="border-radius-50" src="{{ url($company->logo['large']) }}">
                    @endif
                </div>
                <div class="flex one two-700 three-1100 four-fifth ">
                    <div class="">
                        @lang('messages.name'):
                        <span class="text-editor" data-field="manager"
                            data-label="@lang('messages.name')">{{ $company->manager ?? '' }}</span>
                    </div>
                    <div class="">@lang('messages.sale manager'):
                        <span class="text-editor" data-field="sale_manager"
                            data-label="@lang('messages.sale manager')">{{ $company->sale_manager ?? '' }}</span>
                    </div>
                    <div class="">@lang('messages.mobile'):
                        <span class="text-editor" data-field="mobile"
                            data-label="@lang('messages.mobile')">{{ $company->mobile ?? '' }}</span>
                    </div>
                    <div class="">@lang('messages.phone'):
                        <span class="ltr">
                            @isset($company->phone)
                                @foreach ($company->phone as $item)
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
                            data-label="@lang('messages.site')">{{ $company->site ?? '' }}</span>
                    </div>

                    <div class="">@lang('messages.email'): <span class="text-editor" data-field="email"
                            data-label="@lang('messages.email')">{{ $company->email ?? '' }}</span>
                    </div>

                    <div class="">@lang('messages.address'): <span class="text-editor" data-field="address"
                            data-label="@lang('messages.address')">{{ $company->address ?? '' }}</span></div>

                    <div class="">@lang('messages.city'): <span class="text-editor" data-field="city"
                            data-label="@lang('messages.city')">{{ $company->city ?? '' }}</span>
                    </div>

                    <div class="">@lang('messages.province'): <span class="text-editor" data-field="province"
                            data-label="@lang('messages.province')">{{ $company->province ?? '' }}</span></div>

                    <div class="">@lang('messages.whatsapp'): <span class="ltr text-editor" data-field="whatsapp"
                            data-label="@lang('messages.whatsapp')">{{ $company->whatsapp ?? '' }}</span>
                    </div>

                    <div class="">@lang('messages.telegram'): <span class="text-editor" data-field="telegram"
                            data-label="@lang('messages.telegram')">{{ $company->telegram ?? '' }}</span></div>

                    <div class="">@lang('messages.instagram'): <span class="text-editor" data-field="instagram"
                            data-label="@lang('messages.instagram')">{{ $company->instagram ?? '' }}</span></div>

                    <div class="">@lang('messages.register date'): <span>{{ convertGToJ($company->date ?? '') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- all contents --}}
    @if (isset($company->contents) && $company->contents->count())


    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex two two-500  six-800  ">
                    @foreach ($company->contents as $content)
                        <div>
                            <a class="hover shadow2" href="{{ url($content->slug) }}">

                                @if (isset($content->images['thumb']))
                                    <div><img alt="{{ $content->title }}" src="{{ $content->images['thumb'] }}"></div>
                                @endif
                                <footer>
                                    <h3> {{ $content->title }}</h3>
                                    <div>
                                        <div class="rate">
                                            @if (count($content->comments))
                                                @php
                                                    $rateAvrage = $rateSum = 0;
                                                @endphp
                                                @foreach ($content->comments as $comment)
                                                    @php
                                                        $rateSum = $rateSum + $comment['rate'];
                                                    @endphp
                                                @endforeach
                                                @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                    <img width="20" height="20"
                                                        srcset="{{ url(env('TEMPLATE_NAME') . '/img/star2x.png') }} 2x , {{ url(env('TEMPLATE_NAME') . '/img/star1x.png') }} 1x"
                                                        src="{{ url(env('TEMPLATE_NAME') . '/img/star1x.png') }}"
                                                        alt="{{ 'star for rating' }}">
                                                @endfor
                                            @endif
                                        </div>
                                        @if (isset($content->attr['price']))
                                            @convertCurrency($content->attr['price']??0) تومان
                                        @endif
                                    </div>
                                </footer>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-4dNpRvNX0c/TdYEbYup8qbjvjaMrgUPh+g4I03CnNtANuv+VAvPL6LqdwzZKV38G" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
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

        var map = L.map('mapid')
            .setView([{{ $company->location ?? '31.5,51.2' }}], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
            // zoomOffset: -1
            // maxZoom: 18,
            // tileSize: 512
        }).addTo(map);


        //marker
        var marker = L.marker([{{ $company->location ?? '31.5,51.2' }}])
            .addTo(map)
            .bindPopup(`@lang('messages.my location')`)
            .openPopup();



        //meghyas
        L.control.scale().addTo(map);

        //scroll disable zoom
        map.scrollWheelZoom.disable();

    </script>


@endsection
