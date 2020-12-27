<div class="faq">
<div class="flex one">
    @foreach($module['content'] as $key=>$faq)
        <div>
                <div>{!!  $faq['question']!!}</div>
                <div>{!!  $faq['answer']!!}</div>
        </div>
    @endforeach

</div>
</div>