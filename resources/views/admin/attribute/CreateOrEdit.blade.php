@if(isset($attribute))
    @foreach ($attribute->contentAattributeFields as $field)
     <input type="hidden" name="content_type_id" value="{{$attribute->id}}">
    <?php
    // echo ($field->field_name);
    ?>
    <div class="form-group row">
        <div class="col-5 col-md-5">
            @include('admin.attribute.'.ucfirst($field->element_type))
        </div>

    </div>
@endforeach
@endif
