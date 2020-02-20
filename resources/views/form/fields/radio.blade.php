<div class="form-group">
    <label>{{ $field->title }}</label>
    @foreach ($field->values as $key => $value)
        <div class="form-check">
            <input class="form-check-input" name="{{ Str::slug($field->title, '_') }}" type="radio" value="{{ $value->title }}" id="{{ $value->id }}" {{ $key == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $value->id }}">
                {{ $value->title }}
            </label>
        </div>
    @endforeach
</div>
