<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/admin/block/{{ $block->id }}/update">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Blok aanpassen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="nav-home" aria-selected="true">Basis</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#layout" role="tab" aria-controls="nav-profile" aria-selected="false">Ontwerp</a>
                        </div>
                    </nav>
                    <div class="tab-content pt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="form-group">
                                <label>Aantal kolommen</label>
                                <select name="blockData[cols]" class="form-control">
                                    @for($i=1; $i<=6; $i++)
                                        <option {{ ($block->blockData['cols'] ?? 1) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="layout" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group">
                                <label>Achtergrondkleur regel</label>
                                <input type="text" name="blockData[row_bg_color]" class="form-control" value="{{ $block->blockData['row_bg_color'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Achtergrondafbeelding</label>
                                @include ('assets.admin.single', ['name' => 'blockData[row_bg_image]', 'value' => $block->blockData['row_bg_image'] ?? '', 'second' => true])
                            </div>
                            <hr>
                            @for($i=1; $i<=($block->blockData['cols'] ?? 1); $i++)
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Achtergrondkleur kolom {{ $i }}</label>
                                        <input type="text" name="blockData[col_{{ $i }}_bg_color]" class="form-control" value="{{ $block->blockData['col_'.$i.'_bg_color'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Kolom breedte</label>
                                        <select name="blockData[col_{{ $i }}_width]" class="form-control">
                                            @for($a=1;$a<=12;$a++)
                                                <option {{ @$block->blockData['col_'.$i.'_width'] == $a ? 'selected' : '' }} value="{{ $a }}">{{ $a }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="referrer" value="{{ URL::previous() }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
                    <button type="submit" class="btn btn-primary">Blok opslaan</button>
                </div>
            </div>
        </form>
    </div>
  </div>
