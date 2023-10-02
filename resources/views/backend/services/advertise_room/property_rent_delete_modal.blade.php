<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header d-block text-center">
            <h4 class="modal-title d-inline-block">Change status of the property</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p class="text-center">Are you sure that you want to change the status of this property?</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            <button type="button" class="btn btn-primary property_delete_confirm_btn" data-id="{{ $id }}">Change Status</button>
        </div>
    </div>
</div>
