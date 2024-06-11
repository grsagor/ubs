<div class="modal-dialog" role="document">
    <div class="modal-content">

        <form action="" method="POST" enctype="multipart/form-data" id="take_action_form">
            @csrf
            <input type="hidden" name="business_id" value="{{ $business->id }}">
            <input type="hidden" name="id" value="{{ $withdraw->id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Take Action</h4>
            </div>

            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="server_side_error" role="alert">

                    </div>
                    @if ($action == 'accept')
                        <p>Are you sure to accept this request?</p>
                        <input type="hidden" name="action" value="{{ $action }}">
                    @endif
                    @if ($action == 'reject')
                        <p>Are you sure to reject this request?</p>
                        <input type="hidden" name="action" value="{{ $action }}">
                    @endif
                    @if ($action == 'processing')
                        <p>Are you sure to processing this request?</p>
                        <input type="hidden" name="action" value="{{ $action }}">
                    @endif
                    @if ($action == 'complete')
                        <p>Are you sure to complete this request?</p>
                        <input type="hidden" name="action" value="{{ $action }}">
                    @endif
                    @if ($action == 'undo')
                        <p>Are you sure to undo this request?</p>
                        <input type="hidden" name="action" value="{{ $action }}">
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="take_action_btn">Sure</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>

        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
