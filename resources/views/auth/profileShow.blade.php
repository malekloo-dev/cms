@extends(@env('TEMPLATE_NAME').'.App')

@section('twitter:title'){{ $company->name ?? 'comapny' }}@endsection
@section('twitter:description'){{ clearHtml($company->description) }}@endsection

@section('og:type'){{ 'Comapny' }}@endsection
@section('og:title'){{ $company->name ?? 'Company' }}@endsection
@section('og:description'){{ clearHtml($company->description) }}@endsection

    @if (isset($company->logo['medium']))

        @section('twitter:image'){{ url($company->logo['medium']) }}@endsection

        @section('og:image'){{ url($company->logo['medium']) }}@endsection
        @section('og:image:type'){{ 'image/jpeg' }}@endsection
        @section('og:image:width'){{ env('COMPANY_MEDIUM_W') }}@endsection
        @section('og:image:height'){{ env('COMPANY_MEDIUM_H') }}@endsection
        @section('og:image:alt'){{ $company->name ?? 'Company' }}@endsection

        @endif



        @section('Content')


            <section class="breadcrumb my-0" style="padding:10px">
                <div class="flex one  ">
                    <div class="p-0">
                        <a href="/">خانه </a>
                        @if (count($breadcrumb))
                            @foreach ($breadcrumb as $key => $item)
                                <span>></span>
                                <a href="{{ url($item['slug']) }}">{{ $item['title'] }}</a>
                            @endforeach
                            <span>></span> <a href="">{{ $company->name }}</a>
                        @endif
                    </div>
                </div>
            </section>

            <section class="profile-show">
                <div class="flex shadow">
                    <h1 class="full">{{ $company->name ?? '' }}</h1>
                    <div class="map-area" style="display: block; width: 100%;z-index:1">
                        <div id="mapid" style="width: 100%; height: 200px;"></div>
                    </div>
                    <div class="flex one five-700 p-0  ">
                        <div class="one">
                            @if (!isset($company->logo['large']) || $company->logo['large'] == '' || !file_exists(public_path($company->logo['large'])))

                                <img class=" h-auto img-contain  mt-1 " width="100" height="100" src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image"/>

                            @else
                                <img class="border-radius-50" src="{{ url($company->logo['large']) }}">
                            @endif
                        </div>
                        <div class="flex one two-700 three-1100 four-fifth-500 infobox vcard">

                            @if ($company->manager != '')
                                <div class="">
                                    <span class="infobox-label">@lang('messages.name'):</span>
                                    <span class="text-editor infobox-data agent" data-field="manager"
                                        data-label="@lang('messages.name')">{{ $company->manager ?? '' }}</span>
                                </div>
                            @endif
                            @if ($company->sale_manager != '')
                                <div class="">@lang('messages.sale manager'):
                                    <span class="text-editor" data-field="sale_manager"
                                        data-label="@lang('messages.sale manager')">{{ $company->sale_manager ?? '' }}</span>
                                </div>
                            @endif


                            @if ($company->phone != '')

                                <div class="">@lang('messages.phone'):

                                    <div class="flex one two-500 ">
                                        @foreach (explode(',',$company->phone) as $phone)
                                            <div class="p-0">
                                                <a class="company-phone" href="tel:{{ Str::replace('-','',$phone) }}">{{ Str::replace('-','',$phone) }}</a>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                            @if ($company->site != '')
                                <div class="">@lang('messages.site'):
                                    <span class="text-editor" data-field="site" data-label="@lang('messages.site')">
                                        <a href="{{ $company->site }}" rel="nofollow"
                                            target="_blank">{{ str_replace(['http://', 'https://'], '', $company->site ?? '') }}</a>
                                    </span>
                                </div>
                            @endif

                            @if ($company->email != '')
                                <div class="">@lang('messages.email'): <span class="text-editor" data-field="email"
                                        data-label="@lang('messages.email')">{{ $company->email ?? '' }}</span>
                                </div>
                            @endif

                            @if ($company->city != '')
                                <div class="">@lang('messages.city'): <span class="text-editor" data-field="city"
                                        data-label="@lang('messages.city')">{{ $company->city ?? '' }}</span>
                                </div>
                            @endif

                            <div class="full company-address">@lang('messages.address'): <span class="text-editor"
                                    data-field="address"
                                    data-label="@lang('messages.address')">{{ $company->city ?? '' }} {{ $company->address ?? '' }}</span>
                            </div>

                            <div class="full company-categories">
                                @lang('messages.category'):
                                @foreach ($company->categories as $item)
                                    <a href="{{ url($item->slug) }}">{{ $item->title }}</a>
                                @endforeach
                            </div>

                            @if ($company->whatsapp != '')
                                <div class="">@lang('messages.whatsapp'): <span class="ltr text-editor"
                                        data-field="whatsapp"
                                        data-label="@lang('messages.whatsapp')">{{ $company->whatsapp ?? '' }}</span>
                                </div>
                            @endif

                            @if ($company->telegram != '')
                                <div class="">@lang('messages.telegram'): <span class="text-editor"
                                        data-field="telegram" data-label="@lang('messages.telegram')">
                                        <a href="{{ $company->telegram }}" rel="nofollow" target="_blank">
                                            {{ str_replace(['https://telegram.me/'], '', $company->telegram) }}

                                            <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="24px"
                                                height="24px">
                                                <path
                                                    d="M 44.376953 5.9863281 C 43.889905 6.0076957 43.415817 6.1432497 42.988281 6.3144531 C 42.565113 6.4845113 40.128883 7.5243408 36.53125 9.0625 C 32.933617 10.600659 28.256963 12.603668 23.621094 14.589844 C 14.349356 18.562196 5.2382813 22.470703 5.2382812 22.470703 L 5.3046875 22.445312 C 5.3046875 22.445312 4.7547875 22.629122 4.1972656 23.017578 C 3.9185047 23.211806 3.6186028 23.462555 3.3730469 23.828125 C 3.127491 24.193695 2.9479735 24.711788 3.015625 25.259766 C 3.2532479 27.184511 5.2480469 27.730469 5.2480469 27.730469 L 5.2558594 27.734375 L 14.158203 30.78125 C 14.385177 31.538434 16.858319 39.792923 17.402344 41.541016 C 17.702797 42.507484 17.984013 43.064995 18.277344 43.445312 C 18.424133 43.635633 18.577962 43.782915 18.748047 43.890625 C 18.815627 43.933415 18.8867 43.965525 18.957031 43.994141 C 18.958531 43.994806 18.959437 43.99348 18.960938 43.994141 C 18.969579 43.997952 18.977708 43.998295 18.986328 44.001953 L 18.962891 43.996094 C 18.979231 44.002694 18.995359 44.013801 19.011719 44.019531 C 19.043456 44.030655 19.062905 44.030268 19.103516 44.039062 C 20.123059 44.395042 20.966797 43.734375 20.966797 43.734375 L 21.001953 43.707031 L 26.470703 38.634766 L 35.345703 45.554688 L 35.457031 45.605469 C 37.010484 46.295216 38.415349 45.910403 39.193359 45.277344 C 39.97137 44.644284 40.277344 43.828125 40.277344 43.828125 L 40.310547 43.742188 L 46.832031 9.7519531 C 46.998903 8.9915162 47.022612 8.334202 46.865234 7.7402344 C 46.707857 7.1462668 46.325492 6.6299361 45.845703 6.34375 C 45.365914 6.0575639 44.864001 5.9649605 44.376953 5.9863281 z M 44.429688 8.0195312 C 44.627491 8.0103707 44.774102 8.032983 44.820312 8.0605469 C 44.866523 8.0881109 44.887272 8.0844829 44.931641 8.2519531 C 44.976011 8.419423 45.000036 8.7721605 44.878906 9.3242188 L 44.875 9.3359375 L 38.390625 43.128906 C 38.375275 43.162926 38.240151 43.475531 37.931641 43.726562 C 37.616914 43.982653 37.266874 44.182554 36.337891 43.792969 L 26.632812 36.224609 L 26.359375 36.009766 L 26.353516 36.015625 L 23.451172 33.837891 L 39.761719 14.648438 A 1.0001 1.0001 0 0 0 38.974609 13 A 1.0001 1.0001 0 0 0 38.445312 13.167969 L 14.84375 28.902344 L 5.9277344 25.849609 C 5.9277344 25.849609 5.0423771 25.356927 5 25.013672 C 4.99765 24.994652 4.9871961 25.011869 5.0332031 24.943359 C 5.0792101 24.874869 5.1948546 24.759225 5.3398438 24.658203 C 5.6298218 24.456159 5.9609375 24.333984 5.9609375 24.333984 L 5.9941406 24.322266 L 6.0273438 24.308594 C 6.0273438 24.308594 15.138894 20.399882 24.410156 16.427734 C 29.045787 14.44166 33.721617 12.440122 37.318359 10.902344 C 40.914175 9.3649615 43.512419 8.2583658 43.732422 8.1699219 C 43.982886 8.0696253 44.231884 8.0286918 44.429688 8.0195312 z M 33.613281 18.792969 L 21.244141 33.345703 L 21.238281 33.351562 A 1.0001 1.0001 0 0 0 21.183594 33.423828 A 1.0001 1.0001 0 0 0 21.128906 33.507812 A 1.0001 1.0001 0 0 0 20.998047 33.892578 A 1.0001 1.0001 0 0 0 20.998047 33.900391 L 19.386719 41.146484 C 19.35993 41.068197 19.341173 41.039555 19.3125 40.947266 L 19.3125 40.945312 C 18.800713 39.30085 16.467362 31.5161 16.144531 30.439453 L 33.613281 18.792969 z M 22.640625 35.730469 L 24.863281 37.398438 L 21.597656 40.425781 L 22.640625 35.730469 z" />
                                            </svg>
                                        </a>
                                    </span></div>
                            @endif

                            @if ($company->instagram != '')
                                <div class="">
                                    @lang('messages.instagram'):
                                    <a href="{{ $company->instagram ?? '' }}" rel="nofollow" target="_blank">
                                        <svg width="24px" height="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M363.273,0H148.728C66.719,0,0,66.719,0,148.728v214.544C0,445.281,66.719,512,148.728,512h214.544
                                                                                                        C445.281,512,512,445.281,512,363.273V148.728C512,66.719,445.281,0,363.273,0z M472,363.272C472,423.225,423.225,472,363.273,472
                                                                                                        H148.728C88.775,472,40,423.225,40,363.273V148.728C40,88.775,88.775,40,148.728,40h214.544C423.225,40,472,88.775,472,148.728
                                                                                                        V363.272z"></path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256,118c-76.094,0-138,61.906-138,138s61.906,138,138,138s138-61.906,138-138S332.094,118,256,118z M256,354
                                                                                                        c-54.037,0-98-43.963-98-98s43.963-98,98-98s98,43.963,98,98S310.037,354,256,354z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <circle cx="396" cy="116" r="20"></circle>
                                                </g>
                                            </g>
                                        </svg>

                                    </a>

                                </div>
                            @endif

                            <div class="">@lang('messages.register date'):
                                <span>{{ convertGToJ($company->created_at ?? '') }}</span>
                            </div>
                            @if ($company->description != '')
                                <div class="full">@lang('messages.description'): <span class="text-editor"
                                        data-field="description"
                                        data-label="@lang('messages.description')">{!! $company->description ?? '' !!}</span></div>
                            @endif

                        </div>
                    </div>

                </div>
            </section>

            {{-- all contents --}}
            @if (isset($company->contents))


                <section class="index-items home-top-view">
                    <div class="flex one">
                        <div>
                            <div class="flex two two-500  six-800  ">
                                @foreach ($company->contents()->paginate(12) as $content)
                                    <div>
                                        <a class="hover shadow2" href="{{ url($content->slug) }}">

                                            @if (isset($content->images['images']['small']))
                                                <div><img alt="{{ $content->title }}"
                                                        src="{{ $content->images['images']['small'] }}">
                                                </div>
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
                            {{ $company->contents()->paginate(12)->links() }}
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
