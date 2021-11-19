@if(isset($attribute))
    @foreach ($attribute->contentAattributeFields as $field)
    <?php
    // echo ($field->field_name);
     //dd($attribute);
    ?>
    <div class="form-group row">
        <div class="col-5 col-md-5">
            @include('admin.attribute.'.ucfirst($field->element_type))
        </div>

    </div>
@endforeach
@endif
