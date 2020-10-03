<div class="flex one two-500 four-900 center ">

    @foreach($module['content'] as $key=>$faq)
        <div>
                <div>{!!  $faq['question']!!}</div>
                <div>{!!  $faq['answer']!!}</div>
        </div>
    @endforeach

</div>