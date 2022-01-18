@extends(@env('TEMPLATE_NAME').'.App')



@section('meta-title', $detail->title)
@section('meta_description', $detail->title)

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->description))
@section('canonical', url($detail->slug))


@if (isset($detail->images['images']['medium']))
    @section('twitter:image', url($detail->images['images']['medium']))

    @section('og:image', url($detail->images['images']['medium']))
    @section('og:image:type', 'image/jpeg')
    @section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
    @section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
    @section('og:image:alt', $detail->title)

@endif



@section('Content')

    @include('jsonLdWebsite')





    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="search bg-gray-dark mt-0 pt-2">
        <h1 class="text-center">جستجوگر ریموت یدک </h1>
        <div class="flex one two-500  center">

            <form action="{{ route('search') }}" class="">

                <input name="q" alt="جستجو" type="text" value="{{ app('request')->q }}"
                    placeholder="جستجوی محصول / محتوا / کمپانی" required oninvalid="this.setCustomValidity('کلمه ای برای جستجو تایپ کنید')"  onchange="this.setCustomValidity('')">

                <button class=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                        viewBox="0 0 32 32" style=" fill:#000000;">
                        <path
                            d="M 19 3 C 13.488281 3 9 7.488281 9 13 C 9 15.394531 9.839844 17.589844 11.25 19.3125 L 3.28125 27.28125 L 4.71875 28.71875 L 12.6875 20.75 C 14.410156 22.160156 16.605469 23 19 23 C 24.511719 23 29 18.511719 29 13 C 29 7.488281 24.511719 3 19 3 Z M 19 5 C 23.429688 5 27 8.570313 27 13 C 27 17.429688 23.429688 21 19 21 C 14.570313 21 11 17.429688 11 13 C 11 8.570313 14.570313 5 19 5 Z">
                        </path>
                    </svg></button>
            </form>
        </div>
    </section>

    <section class="bg-gray search-items">
        <div class="flex one ">
            <h2>محصولات</h2>
            <div>
                @if (count($products))
                    <div class="flex one two-500  ">

                        {{-- $data['newPost'] --}}
                        @foreach ($products as $content)
                            <a href="{{ $content->slug }}" class="">
                                <div class="shadow hover p-0 border-radius-5 search-item">
                                    @if (isset($content->images['images']['small']) && file_exists(public_path($content->images['images']['small'])))
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="50">

                                    @endif
                                    <div class="py-0 px-1 m-0 ">
                                        <div>{{ $content->title }}</div>
                                        <div>


                                            <span class="rate ">
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
                                                        <label></label>
                                                    @endfor
                                                    <span class="font-09 ml-2">({{ count($content->comments) }}
                                                        نفر)</span>
                                                @endif
                                            </span>

                                            <span class="">
                                                <svg class="p-0  m-0" width="18" height="18" viewBox="0 0 24 18"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span class="">{{ $content->viewCount }}</span>
                                            </span>



                                        </div>
                                    </div>

                                </div>
                            </a>
                        @endforeach

                    </div>

                @else
                    موردی یافت نشد.
                @endif
            </div>
        </div>
    </section>

    <section class="bg-gray search-items">
        <div class="flex one ">
            <h2>مقالات</h2>
            <div>
                @if (count($posts))
                    <div class="flex one two-500   ">

                        @foreach ($posts as $content)

                            <a href="{{ $content->slug }}">
                                <div class="shadow hover p-0 border-radius-5  search-item">

                                    @if (isset($content->images['images']['small']) && file_exists(public_path($content->images['images']['small'])))
                                        <figure class="image m-0" style="width: 70px">
                                            <img src="{{ $content->images['images']['large'] }}"
                                                alt="{{ $content->title }}" title="{{ $content->title }}" width="70"
                                                height="70">

                                        </figure>
                                    @endif

                                    <div class="py-0 px-1 m-0 ">
                                        <div>{{ $content->title }}</div>
                                        <div>


                                            <span class="rate ">
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
                                                        <label></label>
                                                    @endfor
                                                    <span class="font-09 ml-2">({{ count($content->comments) }}
                                                        نفر)</span>
                                                @endif
                                            </span>

                                            <span class="">
                                                <svg class="p-0  m-0" width="18" height="18" viewBox="0 0 24 18"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span class="">{{ $content->viewCount }}</span>
                                            </span>



                                        </div>
                                    </div>

                                </div>
                            </a>
                        @endforeach

                    </div>
                @else
                    موردی یافت نشد.
                @endif
            </div>
        </div>
    </section>



    <section class="bg-gray search-items">
        <div class="flex one ">
            <h2>کمپانی ها</h2>
            @if (count($companies))
                <div>

                    <div class="flex one two-500 center ">

                        @foreach ($companies as $content)
                            <a href="{{ route('profile.index', $content) }}">
                                <div class="shadow hover p-0 border-radius-5 search-item ">


                                    @if (isset($content->logo['small']) && file_exists(public_path($content->logo['small'])))
                                        <div><img width="70" height="70" title="{{ $content->title }}"
                                                alt="{{ $content->title }}" loading="lazy"
                                                src="{{ $content->logo['small'] }}"></div>
                                    @endif

                                    <div class="py-0 px-1 m-0 ">
                                        <div>{{ $content->name }}</div>
                                        <div>



                                            <span class="">
                                                <svg class="p-0  m-0" width="18" height="18" viewBox="0 0 24 18"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span class="">{{ $content->viewCount }}</span>
                                            </span>



                                        </div>
                                    </div>


                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            @else
                موردی یافت نشد.
            @endif
        </div>
    </section>






@endsection
