@if (isset($attribute) and is_object($attribute))
    @foreach ($attribute->contentAattributeFields as $field)
        <input type="hidden" name="content_type_id" value="{{ $attribute->id }}">
        <?php
        // echo ($field->field_name);
        ?>
        <div class="col-6 col-md-6">
            @include('admin.attribute.'.ucfirst($field->element_type))
        </div>
    @endforeach
@endif
