
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

                        $('.sortable').sortable({
                            delay: 300,
                            update: function( event, ui ) {

                            var action = $(this).data('action');
                            var data = $(this).sortable('toArray');

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {'items' : data},
                                url: action,
                                type: 'POST',
                                dataType: 'json'
                            });
                            }
                        });
                    });
                }
            });
        }
    };

    function editImage(id)
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/asset/edit/' + id,
            type: 'POST',
            success: function(data) {
                $('body').append(data);
                $('.modal').modal('show');
                $('.modal').on('hidden.bs.modal', function (e) {
                    $('.modal').remove();
                });
            },
            dataType: 'html'
        });
    }
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
                        <div class="row" id="{{ $asset->id }}">
                            <div class="col">
                                <img data-dz-thumbnail src="{{ asset('assets/'. $asset->file) }}" class="img-thumbnail">
                            </div>
                            <div class="col">
                                @if ($file_data ?? '' == true)
                                    <a href="javascript:;" onclick="return editImage('{{ $asset->id }}')">Bewerk</a>
                                @endif
                                <a href="{{ route('admin.asset.delete', $asset) . '#' . $anchor ?? '' }}" class="text-danger" onclick="return confirm('Afbeelding verwijderen?')">Verwijder</a>
                            </div>
                        </div>
                    @empty
                        <p>Er zijn nog geen afbeeldingen geupload.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
