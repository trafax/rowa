<script type="text/javascript">
function newModel(object) {
    var code = Math.random().toString(36).substr(2, 9);
    $(object).closest('.input-group').find('.file').attr('data-id', code);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: code},
        url: '{{ route('admin.asset.single_dropzone') }}',
        type: 'POST',
        success: function(response)
        {
            $('body').append(response);
            $('.modal').modal('show');

            @if (($second ?? false) == false)
                $('.modal').on('hidden.bs.modal', function (e) {
                    $('.modal').remove();
                });
            @endif

        }
    });
}
</script>

<div class="input-group">
    <input type="text" placeholder="Afbeelding" name="{{ $name ?? '' }}" data-id="" value="{{ $value ?? '' }}" class="form-control file">
    <div class="input-group-append">
        <div class="input-group-text"><a href="javascript:;" onclick="return newModel($(this))" class="open_modal_">Upload</a></div>
    </div>
</div>
