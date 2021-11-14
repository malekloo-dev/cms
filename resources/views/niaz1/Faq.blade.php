<div class="faq schema-faq">
<div class="flex one">
    @foreach($module['content'] as $key=>$faq)
        <div class="schema-faq-section">
                <div class="schema-faq-question">{!!  $faq['question']!!}</div>
                <div class="schema-faq-answer">{!!  $faq['answer']!!}</div>
        </div>
    @endforeach

</div>
</div>
