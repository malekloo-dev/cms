<?php
$val='';
//var_dump($field->checkValueRelation());
if (!Request()->is('*create*') and (isset($field->value) and ($field->value!=null)) ){
    $val=$field->value->value;
}
?>
<label for="attr_{{ $field->id }}_{{ $field->field_name }}" class=" col-form-label">{{ $field->label }}:</label>

<select class=" select2" name="attr_{{ $field->id }}_{{ $field->field_name }}"
    id="attr_{{ $field->id }}_{{ $field->field_name }}">
    <option value="">یکی از موارد زیر را انتخاب نمایید</option>
    @foreach ($field->ComboFields as $option)
        <option value="{{ $option->value }}" {{ ($option->value ?? '') == $val ? 'selected' : '' }}>
            {{ $option->name }}</option>
    @endforeach
</select>


