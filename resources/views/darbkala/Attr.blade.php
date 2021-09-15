<div class="attr">
    <div class="">
    @foreach($module['content'] as $key=>$attr)

        <div class="">
            <div >
                {!! isset($attr['field']) ? $attr['field'] :'' !!}

            </div>
            <div >
                {!! isset($attr['value']) ? $attr['value'] :'' !!}
            </div>
        </div>
        @endforeach
    </div>
</div>