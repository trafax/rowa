@extends('layouts.website')

@section('content')

    <div class="home-slider d-none d-md-block">
        <div class="bx-slider">
            @foreach ($page->assets as $asset)
                <div style="background-image: url('{{ asset('assets/' . $asset->file) }}')" class="slide">
                    <div class="container main position-relative h-100">
                        @if (isset($asset->file_data['title']))
                            <div class="caption">
                                <h3>{{ $asset->file_data['title'] ?? '' }}</h3>
                                <h4>{{ $asset->file_data['description'] ?? '' }}</h4>
                                <a href="{{ $asset->file_data['btn_link'] ?? '' }}" class="button">{{ $asset->file_data['btn_text'] ?? '' }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $('.bx-slider').bxSlider({
        });
    </script>

    <div class="row homeblocks m-0">
        @foreach ($homeBlocks as $homeBlock)
            <div class="col-md-4">
                <div class="overlay" style="{{ $homeBlock->navigation_image ? 'background-image: url('.asset($homeBlock->navigation_image).')' : '' }}"></div>
                <a href="{{ route('page', $homeBlock->slug) }}" class="stretched-link">{{ $homeBlock->title }}</a>
            </div>
        @endforeach
    </div>

    <div class="home-video mb-4 d-none d-lg-block">
        <div class="container main">
            <div class="bg-white text-center py-4">
                <h2>ROWA DRUK & MEDIA</h2>
                <h3>UW MEDIABEDRIJF MET EEN PERSOONLIJK TINTJE</h3>
                <video autoplay="" loop="" width="95%" class="mt-4">
                    <source src="/img/RoWa_Bedrijfsvideo.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

    @if (Auth::user() && Auth::user()->role == 'admin')
        <div class="container main mt-4">
            <div class="border p-2 text-center position-relative mb-4 bg-light"><a href="javascript:;" data-parent_id="{{ $page->id }}" onclick="return window.create_block($(this).data())" class="stretched-link text-decoration-none">Blok toevoegen</a></div>
        </div>
    @endif

    <div class="{{ Auth::user() && Auth::user()->role == 'admin' ? 'sortable' : '' }}" data-action="/admin/block/sort">
        @foreach ($page->blocks as $block)
        <div style="{!! ($block->blockData['row_bg_color'] ?? null) ? 'background-color: '.$block->blockData['row_bg_color'].';' : '' !!} {!! ($block->blockData['row_bg_image'] ?? null) ? 'background-image: url('.$block->blockData['row_bg_image'].');' : '' !!}" class="mb-4 block-row {{ ($block->blockData['row_bg_color'] ?? '') ? 'py-4' : 'p-0' }}">
            <div class="container main">
                <div class="row position-relative" id="{{ $block->id }}">
                    @for($i=1; $i<=($block->blockData['cols'] ?? 1); $i++)
                        <div class="col-md {{ ($block->blockData['col_'.$i.'_width'] ?? null) ? 'col-md-' . $block->blockData['col_'.$i.'_width'] : '' }}">
                            <div class="{{ ($block->blockData['col_'.$i.'_bg_color'] ?? '') ? 'p-3' : 'p-0' }} mb-4" style="{!! ($block->blockData['col_'.$i.'_bg_color'] ?? null) ? 'background-color: '.$block->blockData['col_'.$i.'_bg_color'].';' : '' !!}">
                            @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor border mb-3" data-identifier="{{ $block->id }}-{{ $i }}" data-action="/admin/text/store"> @endif
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

    <div class="container main my-4">
        <script type="text/javascript">
            $(document).ready(function() {
                $("#projects").lightSlider({
                    pager: false,
                    controls: false,
                    item: 5,
                    auto: true,
                    loop: true,
                    speed: 800,
                    pause: 4000,
                });
            });
        </script>

        <h3 class="text-center mb-4 blue-heading">ONLANGS AFGEROND</h3>
        <hr class="mb-4">
        <ul id="projects" class="mb-4">
            @foreach (App\Models\Asset::where('parent_id', 'projects')->orderBy('sort')->get() as $asset)
                <li><a href="{{ $asset->file_data['btn_link'] ?? 'javascript:;' }}" {!! @$asset->file_data['btn_link'] ? 'target="_blank"' : '' !!} class="projectslide" style="background-image: url({{ asset('assets/' . $asset->file) }});"></a></li>
            @endforeach
        </ul>
    </div>

    <div class="container main my-4">
        <script type="text/javascript">
            $(document).ready(function() {
                $("#referenties").lightSlider({
                    pager: false,
                    controls: false,
                    item: 5,
                    auto: false,
                    loop: true,
                    speed: 800,
                    pause: 4000,
                });
            });
        </script>

        <h3 class="text-center mb-4 blue-heading">REFERENTIES</h3>
        <hr class="mb-4">
        <ul id="referenties" class="mb-4">
            @foreach (App\Models\Asset::where('parent_id', 'referenties')->orderBy('sort')->get() as $asset)
                <li><a href="{{ $asset->file_data['btn_link'] ?? 'javascript:;' }}" {!! @$asset->file_data['btn_link'] ? 'target="_blank"' : '' !!} class="referentie" style="background-image: url({{ asset('assets/' . $asset->file) }});"></a></li>
            @endforeach
        </ul>
    </div>

    <div class="container main my-4 pt-4" id="mailchimp">
        <div class="row">
            <div class="col">
                <div class="cardd">
                     <div class="h3 blue-heading text-center">Aanmelden nieuwsbrief</div>
                     <hr>
                     <div class="card-bodyy mt-4">
                         @if (session('message'))
                             <div class="alert alert-success">
                                 {!! session('message') !!}
                             </div>
                         @endif
                         <form method="post" action="{{ route('mailchimp.subscribe') }}">
                             @csrf
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Voornaam</label>
                                         <input type="text" name="fname" class="form-control" required>
                                         @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Achternaam</label>
                                         <input type="text" name="lname" class="form-control" required>
                                         @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>E-mailadres</label>
                                         <input type="email" name="email" class="form-control" required>
                                         @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <button class="btn button-blue">Inschrijven</button>
                             </div>
                         </form>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection
