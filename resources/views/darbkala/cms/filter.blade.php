<div>
    لیست فیلتر ها
</div>

@if (count($filterList['removeFilter']))
    <div class="  shadow filter-remote-link">
        @foreach ($filterList['removeFilter'] as $key => $filterItem)
            <a class="" href="{{ $filterItem['url'] }}">{{ $filterItem['name'] }} </a>
        @endforeach
    </div>
@endif




@if (count($filterList['filter']))
    <div class="flex one filter-items">
        @foreach ($filterList['filter'] as $key => $filterItem)
            <div class="toc1 shadow mt-1 ">
                <a class="filter-header border-radius-15" href="#{{ $filterItem['label'] }}">{{ $filterItem['label'] }}</a>
                <div class="filter-items-list">

                @foreach ($filterItem->filterItemDetails as $key2 => $filterOption)
                    <div class="toc1">
                        @if ($filterOption['check'] == 'checked')
                        ✔ {{ $filterOption['name'] }}
                        @else
                            <a href="{{ $filterOption['url'] }}">{{ $filterOption['name'] }}</a>
                        @endif
                        {{-- <input type="checkbox" name="vehicle3" value="Boat" {{ $filterOption['check'] }}> --}}
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
@endif
