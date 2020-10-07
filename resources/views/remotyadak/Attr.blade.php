
    @foreach($module['content'] as $key=>$faq)
        <div class="flex one two-500 four-900 center ">

        <div>
            <div>{!!  $faq['field']!!}</div>
        </div>
        <div>
            <div>{!!  $faq['value']!!}</div>
        </div>
        </div>
    @endforeach

