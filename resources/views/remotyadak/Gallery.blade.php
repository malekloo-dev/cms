<div class="gallery">
<div class="flex one two-500 four-900 center ">

    @foreach($module['content'] as $key => $image)
        <div>
         

             {{--<img src="blank.gif" class="lazy" data-src="{{ $image['src']}}" width="240" height="152">--}}

             <img src="{{ $image['src']}}" >

         
        </div>
    @endforeach
</div>
</div>