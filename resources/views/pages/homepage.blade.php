@extends('layouts.website')

@section('content')

    <div class="home-slider">
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
@endsection
