<div class="form-group">
    <label>{{ t($field, 'title') }}</label>
    @foreach ($field->values as $value)
        <div class="form-check">
            <input class="form-check-input" name="{{ Str::slug(($field->title, '_') }}[]" {{ @in_array($value->title, old(Str::slug(($field->title, '_'))) ? 'checked' : '' }} type="checkbox" value="{{ $value->title }}" id="{{ $value->id }}">

            <label class="form-check-label" for="{{ $value->id }}">
                {{ $value->title }}
            </label>
        </div>
    @endforeach
    @if ($errors->has(Str::slug($field->title, '_')))
        <span class="text-danger">{{ ucfirst($errors->first(Str::slug($field->title, '_'))) }}</span>
    @endif
</div>
