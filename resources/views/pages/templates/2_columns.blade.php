<div class="main container">
    <div class="row">
        <div class="col-md-6">
            @if (Auth::user() && Auth::user()->role == 'admin') <div class="my-4 inline-editor" data-identifier="{{ $page->id }}-1" data-action="/admin/text/store"> @endif
                {!! text($page->id . '-1') !!}
            @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
        </div>
        <div class="col-md-6">
            @if (Auth::user() && Auth::user()->role == 'admin') <div class="my-4 inline-editor" data-identifier="{{ $page->id }}-2" data-action="/admin/text/store"> @endif
                {!! text($page->id . '-2') !!}
            @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
        </div>
    </div>
</div>
