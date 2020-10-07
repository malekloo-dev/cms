<div class="attr">
    <div class="">
    @foreach($module['content'] as $key=>$faq)
        <div class="">
            <div >
                {!!  $faq['field']!!}
            </div>
            <div >
                {!!  $faq['value']!!}
            </div>
        </div>
        @endforeach
    </div>
</div>