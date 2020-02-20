<div class="form-group">
    <label>{{ $field->title }}</label>
    <select name="{{ Str::slug($field->title, '_') }}" class="form-control">
        @foreach ($field->values as $value)
            <option {{ old($field->title) == $value->title ? 'selected' : '' }} value="{{ $value->title }}">{{ $value->title }}</option>
        @endforeach
    </select>
</div>
