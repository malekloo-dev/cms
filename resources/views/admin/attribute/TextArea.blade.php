<?php
$val='';
//dd($contentType);
if(isset($field->value->value)){
    $val=$field->value->value;
}
?>
<label for="attr_{{ $field->id }}_{{ $field->field_name }}" class=" col-form-label">{{ $field->label }}:</label>
<textarea class="form-control"  name="attr_{{ $field->id }}_{{ $field->field_name }}" rows="4" cols="50"><?php echo nl2br($val)?></textarea>

