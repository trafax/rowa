@php $uniq_string = uniqid(1); @endphp
<script>
    $(function(){
        $('.open_modal_{{ $uniq_string }}').on('click', function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: '{{ $uniq_string }}'},
                url: '{{ route('admin.asset.single_dropzone') }}',
                type: 'POST',
                success: function(response)
                {
                    $('body').append(response);
                    $('.modal').modal('show');
                    $('.modal').on('hidden.bs.modal', function (e) {
                        $('.modal').remove();
                    });

                }
            });
        });
    });
</script>
<div class="input-group">
    <input type="text" name="{{ $name ?? '' }}" data-id="{{ $uniq_string }}" value="{{ $value ?? '' }}" class="form-control">
    <div class="input-group-append">
        <div class="input-group-text"><a href="javascript:;" class="open_modal_{{ $uniq_string }}">Upload</a></div>
    </div>
</div>
