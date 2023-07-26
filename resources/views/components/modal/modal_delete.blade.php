<div class="modal fade" id="modalDeleteFieldBlade" tabindex="-1" aria-labelledby="modalDeleteFieldBladeLabel" aria-hidden="true" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="resRLabel">Удалить <span data-modal_delete_field_head></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы действительно хотите удалить <span data-modal_delete_field_text></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal page" data-bs-dismiss="modal">Не удалять</button>
                <button type="button" class="btn btn-danger page" data-modal_delete_field_delete data-token="{{ csrf_token() }}">Удалить</button>
            </div>
        </div>
    </div>
</div>
