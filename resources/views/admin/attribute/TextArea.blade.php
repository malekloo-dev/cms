<?php
$val = '';
if (!Request()->is('*create*') and (isset($field->value) and ($field->value!=null)) ){
    $val=$field->value->value;
}
?>
<label for="attr_{{ $field->id }}_{{ $field->field_name }}" class=" col-form-label">{{ $field->label }}:</label>
<textarea class="form-control" name="attr_{{ $field->id }}_{{ $field->field_name }}" rows="4"
    cols="50"><?php echo nl2br($val); ?></textarea>
