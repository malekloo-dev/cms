<div class="attr">
    <div class="">
    @foreach($module['content'] as $key=>$attr)
        <div class="">
            <div >
                {!!  $attr['field']!!}
            </div>
            <div >
                {!!  $attr['value']!!}
            </div>
        </div>
        @endforeach
    </div>
</div>