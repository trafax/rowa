<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/admin/block/store">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Blok toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Aantal kolommen</label>
                        <select name="blockData[cols]" class="form-control">
                            @for($i=1; $i<=6; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="parent_id" value="{{ $request->get('parent_id') }}">
                    <input type="hidden" name="referrer" value="{{ URL::previous() }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-primary">Blok toevoegen</button>
                </div>
            </div>
        </form>
    </div>
  </div>
