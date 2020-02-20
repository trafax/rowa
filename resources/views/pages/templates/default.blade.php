<div class="main container">
    @if (Auth::user() && Auth::user()->role == 'admin') <div class="my-4 inline-editor" data-identifier="{{ $page->id }}" data-action="/admin/text/store"> @endif
        {!! text($page->id) !!}
    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
</div>
