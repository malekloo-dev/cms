<div class="flex one two-500 four-900 center ">

    @foreach($module['content'] as $key=>$image)
        <div>
                @if (isset($image['src']))
                    <div><img src="{{ $image['src']}}"></div>
                @endif
        </div>
    @endforeach

</div>
