<div class="modal-dialog" role="document">
    <form action="{{ route("shop.share.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $location->id }}" name="shop_id">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="shopShareModalLabel">Confirm Sharing Shop</h4>
            </div>
            <div class="modal-body">
                <p>Shop name: <strong>{{ $location->name }}</strong></p>
                <p>Are you sure to share this shop?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </form>
</div>