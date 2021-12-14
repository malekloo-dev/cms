<?php
$val='';
if (!Request()->is('*create*') and (isset($field->value) and ($field->value!=null)) ){
    $val=$field->value->value;
}
?>
<label for="attr_{{ $field->id }}_{{ $field->field_name }}" class=" col-form-label">{{ $field->label }}:</label>
<input type="text" class="form-control" name="attr_{{ $field->id }}_{{ $field->field_name }}"
       value="{{ old($field->field_name,$val ?? '') }}" />
<!--$field->content_attribute_id)->get()->value -->
