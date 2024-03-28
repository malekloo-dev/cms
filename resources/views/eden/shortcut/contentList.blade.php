@isset($content_list)

    <div class="grid grid-cols-2 md:grid-cols-{{ $limit }} gap-2 my-5">
        @if (count($content_list))
            @foreach ($content_list as $content)
                <a href="{{ url($content->slug) }}">
                    <div class="shadow hover p-0 mb-2 ">
                        @if (isset($content->images['images']['small']))
                            <figure class="image ">
                                @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                    <div class="not-in-stock">قابل سفارش</div>
                                @endif
                                <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                    title="{{ $content->title }}" loading="lazy" width="400" height="400">
                                <figcaption>
                                    <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                    <div class=" text-green font-09 ">
                                        @isset($content->attr['weight'])
                                            @convertCurrency($content->GoldPrice()['totalPrice']) تومان
                                        @else
                                            تماس گرفته شود
                                        @endisset
                                    </div>
                                </figcaption>
                            </figure>
                        @else
                            <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                        @endif

                    </div>
                </a>
            @endforeach
        @endif

    </div>
@endisset
