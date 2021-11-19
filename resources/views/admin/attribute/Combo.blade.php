<select name="attr_{{ $field->id }}_{{ $field->field_name }}" id="attr_{{ $field->id }}_{{ $field->field_name }}">
@foreach ($field->ComboFields as $option)
    <option value="{{ $option->value }}">{{ $option->name }}</option>
@endforeach
</select>


