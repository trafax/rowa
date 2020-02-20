<div class="main container">
    @if (Auth::user() && Auth::user()->role == 'admin') <div class="my-4 inline-editor" data-identifier="{{ $page->id }}" data-action="/admin/text/store"> @endif
        @php
            $content = text($page->id);

            if (! Auth::user() || (Auth::user() && Auth::user()->role != 'admin')) {
                preg_match_all('/module="(.*?)" id="(.*?)"/', $content, $modules);

                foreach ($modules[2] as $key => $id)
                {
                    $replacement = App\Http\Controllers\FormController::parseForm($id);

                    $content = preg_replace('/\[shortcode module="(.*?)" id="'.$id.'"\]/', $replacement, $content);
                }
            }

            echo $content;
        @endphp
    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
</div>
