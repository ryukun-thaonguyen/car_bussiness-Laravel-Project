<div class="modal" id="rating">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/rating" method="post">
            @csrf
            <div style="text-align: center" class="modal-header">
                <h4  class="modal-title">Rate this product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="padding: 0px 100px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input  id="rating-input" name="rate" type="text" title=""/>
                        <input type="number" name="productId" hidden value="{{ $product[0]->id }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="height: 100%;float: right" class="btn btn-primary">Rate</button>
            </div>
        </form>
        </div>
      </div>
</div>

