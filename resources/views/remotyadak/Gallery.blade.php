@php
    $sizes = ['one','two','tree','four','five','six','seven','eight','nine','ten','eleven','twelve'];
 if(isset($module['config']['size'])){
     if ($module['config']['size'] <= 12) {
         $size = $module['config']['size'];
     }else{
         $size = 4;
     }
 }
@endphp
<div class="gallery">
<div class="flex one two-500 {{$sizes[$size]}}-900 center ">

    @foreach($module['content'] as $key => $image)
        <div>
         

             {{--<img src="blank.gif" class="lazy" data-src="{{ $image['src']}}" width="240" height="152">--}}

             <img src="{{ $image['src']}}" >

         
        </div>
    @endforeach
</div>
</div>