@extends('layouts.website')

@section('content')
    <div class="container main">
        <h1 class="mb-4">{{ $page->title }}</h1>
    </div>

    @if (Auth::user() && Auth::user()->role == 'admin')
        <div class="container main">
            <div class="border p-2 text-center position-relative mb-4 bg-light"><a href="javascript:;" data-parent_id="{{ $page->id }}" onclick="return window.create_block($(this).data())" class="stretched-link text-decoration-none">Blok toevoegen</a></div>
        </div>
    @endif

    <div class="{{ Auth::user() && Auth::user()->role == 'admin' ? 'sortable' : '' }}" data-action="/admin/block/sort">
        @foreach ($page->blocks as $block)
        <div style="{!! ($block->blockData['row_bg_color'] ?? null) ? 'background-color: '.$block->blockData['row_bg_color'].';' : '' !!}" class="mb-4 {{ ($block->blockData['row_bg_color'] ?? '') ? 'py-4' : 'p-0' }}">
            <div class="container main">
                <div class="row position-relative" id="{{ $block->id }}">
                    @for($i=1; $i<=($block->blockData['cols'] ?? 1); $i++)
                        <div class="col-md">
                            <div class="{{ ($block->blockData['col_'.$i.'_bg_color'] ?? '') ? 'p-3' : 'p-0' }}" style="{!! ($block->blockData['col_'.$i.'_bg_color'] ?? null) ? 'background-color: '.$block->blockData['col_'.$i.'_bg_color'].';' : '' !!}">
                            @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor border mb-0" data-identifier="{{ $block->id }}-{{ $i }}" data-action="/admin/text/store"> @endif
                                @php
                                    $content =  text($block->id . '-' . $i);

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
                        </div>
                    @endfor

                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <div class="actions">
                            <
                            <a href="javascript:;" class="mover d-block">Versleep</a>
                            <a href="javascript:;" onclick="window.edit_block($(this).data())" data-id="{{ $block->id }}" class="d-block">Bewerk</a>
                            <a href="javascript:;" class="d-block text-danger" data-id="{{ $block->id }}" onclick="window.delete_block($(this).data())">Verwijder</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
