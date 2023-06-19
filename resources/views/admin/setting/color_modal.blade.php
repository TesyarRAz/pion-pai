<form id="{{ $id }}" class="modal fade" method="post"
    action="{{ route('admin.setting.store', ['name' => $name]) }}" aria-modal="true" role="dialog">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pengaturan</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Value</label>
                    <input type="color" name="value" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
            </div>
        </div>
    </div>
</form>
