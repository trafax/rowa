<div class="form-group">
    <label>{{ $field->title }}</label>
    <input type="email" name="{{ Str::slug($field->title, '_') }}" value="{{ old($field->title) }}" class="form-control">
    @if ($errors->has(Str::slug($field->title, '_')))
        <span class="text-danger">{{ ucfirst($errors->first(Str::slug($field->title, '_'))) }}</span>
    @endif
</div>
