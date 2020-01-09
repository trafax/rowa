<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Upload bestand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <script type="text/javascript">
                $('.modal').on('shown.bs.modal', function (e) {
                    $("div#customDropzonee").dropzone({
                        url: "{{ route('admin.asset.upload_onthefly') }}",
                        dictDefaultMessage: '- Sleep uw bestanden hierin om deze to uploaden -',
                        maxFiles: 1,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        init: function() {
                        this.on("sending", function(file, xhr, formData){
                            formData.append('parent_id', '');
                        });
                        this.on("complete", function (file) {
                            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                                $('[data-id="{{ $request->get('id') }}"]').val('./assets/' + file.name);
                            }
                        });
                    }
                    });
                });

            </script>
            <div class="dropzone" id="customDropzonee"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
        </div>
        </div>
    </div>
</div>
