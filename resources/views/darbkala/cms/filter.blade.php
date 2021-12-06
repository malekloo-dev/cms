@if(count($filterList['removeFilter']))
    <div class="flex one four-500 ">

    @foreach ($filterList['removeFilter'] as $key => $filterItem)
        حذف فیلنر
        -
        <a href="{{$filterItem['url']}}">{{ $filterItem['name'] }}</a>

    @endforeach
    </div>
@endif
لیست فیلتر ها

@if(count($filterList['filter']))
    <div class="flex one four-800 ">
    @foreach ($filterList['filter'] as $key => $filterItem)
        <li class="toc1">
            <a href="#{{ $filterItem['label'] }}">{{ $filterItem['label'] }}</a>
            @php

                @endphp
            <ul>
                @foreach ($filterItem->filterItemDetails as $key2 => $filterOption)
                    <li class="toc1">
                        <!-- <label for="vehicle2"> I have a car</label><br>-->
                        <input type="checkbox" name="vehicle3" value="Boat" {{ $filterOption['check'] }}>
                        <a href="{{$filterOption['url']}}">{{ $filterOption['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
    </div>
@endif
