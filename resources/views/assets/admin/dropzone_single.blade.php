<script type="text/javascript">
    Dropzone.options.customDropzone = {
        url: '{{ route('admin.asset.upload') }}',
        dictDefaultMessage: '- Sleep uw bestanden hierin om deze to uploaden -',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        maxFiles: 1,
        init: function() {
            this.on("sending", function(file, xhr, formData){
                formData.append('parent_id', '{{ $parent_id }}');
            });
            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    // $('.image-wrapper').load(' .image-container', function(){
                    //     window.sort();
                    // });
                }
            });
        }
    };
</script>

<div class="dropzone" id="customDropzone"></div>
