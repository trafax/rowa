<div class="modal" tabindex="-1" role="dialog">
    <form action="{{ route('admin.asset.update', $asset) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bestand aanpassen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Titel</label>
                    <input type="text" name="file_data[title]" value="{{ $asset->file_data['title'] ?? '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Omschrijving</label>
                    <input type="text" name="file_data[description]" value="{{ $asset->file_data['description'] ?? '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Knop tekst</label>
                    <input type="text" name="file_data[btn_text]" value="{{ $asset->file_data['btn_text'] ?? '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Knop link</label>
                    <input type="text" name="file_data[btn_link]" value="{{ $asset->file_data['btn_link'] ?? '' }}" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </div>
            </div>
        </div>
    </form>
</div>
