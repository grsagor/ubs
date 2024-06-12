<div class="modal-dialog" role="document">
    <div class="modal-content">

        <form action="" method="POST" enctype="multipart/form-data" id="add_request_form">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Withdraw Request</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <p class="col-md-4">Business Name</p>
                    <p class="col-md-6">{{ $business->name }}</p>
                </div>
                <div class="row">
                    <p class="col-md-4">Business Wallet</p>
                    <p class="col-md-6">{{ $business->wallet }}</p>
                </div>
                <div class="row">
                    <p class="col-md-4">Withdraw amount</p>
                    <p class="col-md-6">{{ $withdraw->amount }}</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>

        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
