
<script type="text/javascript">
    Dropzone.options.customDropzone = {
        url: '{{ route('admin.asset.upload') }}',
        dictDefaultMessage: '- Sleep uw bestanden hierin om deze to uploaden -',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            this.on("sending", function(file, xhr, formData){
                formData.append('parent_id', '{{ $parent_id }}');
            });
            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    $('.image-wrapper').load('{{ $reload_url }} .image-container', function(){

                    });
                }
            });
        }
    };
</script>

<div class="row">
    <div class="col">
        <h2 class="h4">Upload nieuwe foto</h2>
        <div class="dropzone" id="customDropzone"></div>
    </div>
    <div class="col">
        <div class="image-wrapper">
            <h2 class="h4">Geüploade foto's</h2>
            <div class="image-container">
                <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete d-flex flex-wrap sortable" data-action="{{ route('admin.asset.sort') }}">
                    @forelse ($assets as $asset)
                        <div class="dz-image" id="{{ $asset->id }}">
                            <a href="{{ route('admin.asset.delete', $asset) . '#' . $anchor ?? '' }}" class="thumb-delete" onclick="return confirm('Afbeelding verwijderen?')">
                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>
                            </a>
                            <img data-dz-thumbnail src="{{ asset('assets/'. $asset->file) }}" class="img-thumbnail">
                        </div>
                    @empty
                        <p>Er zijn nog geen afbeeldingen geupload.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
