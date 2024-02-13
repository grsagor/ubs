            <form action="{{ route('product.resell.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <input type="hidden" name="max_discount" id="max_discount" value="{{ $product->discount_amount }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Resell product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="selling_price_group_id">Add or Discount</label>
                                    <select class="form-control" name="add_discount">
                                        <option selected value="add">Add</option>
                                        @if ($product->is_discount == 1)
                                            <option value="discount">Discount</option>                                            
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="location_id">Add amouont:</label>
                                    <input class="form-control" placeholder="Add amount" name="amount"
                                        type="number" id="amount">
                                    <span class="text-danger" id="amount_error" style="display: none;">You can discount more than {{ $product->discount_amount }}%.</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="save__btn">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
