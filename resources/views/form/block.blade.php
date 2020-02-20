@if (session('message'))
    <div class="alert alert-success" role="alert">
        {!! session('message') !!}
    </div>
@endif
<form method="post" action="{{ route('form.send', $form) }}">
    @csrf
    @foreach ($form->fields as $field)
        @switch($field->type)
            @case('text')
                @include('form.fields.text')
                @break
            @case('textarea')
                @include('form.fields.textarea')
                @break
            @case('dropdown')
                @include('form.fields.dropdown')
                @break
            @case('checkbox')
                @include('form.fields.checkbox')
                @break
            @case('radio')
                @include('form.fields.radio')
                @break
            @case('email')
                @include('form.fields.email')
                @break
        @endswitch
    @endforeach

    <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
</form>
