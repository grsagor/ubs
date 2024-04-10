<div class="modal-dialog" role="document">
    <div class="modal-content">

        <form action="" method="POST" enctype="multipart/form-data" id="add_request_form">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Withdraw Request</h4>
            </div>

            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="server_side_error" role="alert">
        
                    </div>
                </div>

                <div class="form-group">
                    <label for="account_name">Account Name:*</label>
                    <input class="form-control" required="" placeholder="Name" name="account_name" type="text"
                        id="account_name" required>
                </div>

                <div class="form-group">
                    <label for="account_no">Account Number:*</label>
                    <input class="form-control" required="" placeholder="Account Number" name="account_no"
                        type="text" id="account_no" required>
                </div>
                <div class="form-group">
                    <label for="account_branch">Account Branch Name:*</label>
                    <input class="form-control" required="" placeholder="Account Branch Name" name="account_branch"
                        type="text" id="account_branch" required>
                </div>

                <div class="form-group">
                    <label for="amount">Withdraw Amount:</label>
                    <input class="form-control input_number" placeholder="Withdraw Amount" name="amount"
                        type="text" value="0" id="amount" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="request_btn">Send Request</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>

        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
