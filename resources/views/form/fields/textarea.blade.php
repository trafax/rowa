<div class="form-group">
    <label>{{ $field->title }}</label>
    <textarea name="{{ Str::slug($field->title, '_') }}" class="form-control" rows="5">{{ old($field->title) }}</textarea>
    @if ($errors->has(Str::slug($field->title, '_')))
        <span class="text-danger">{{ ucfirst($errors->first(Str::slug($field->title, '_'))) }}</span>
    @endif
</div>
