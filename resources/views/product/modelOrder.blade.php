
<div class="modal" id="orderModel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="order" method="post">
            @csrf
            <div class="modal-header">
            <h4 class="modal-title">Your Information</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <div class="container">
                <input type="text" name="idUser" hidden value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label for="">Your name</label>
                    <input type="text" value="{{ Auth::user()->fullname }}" required class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Your mail</label>
                    <input type="text" value="{{ Auth::user()->email }}" required class="form-control" name="gmail" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Phone number</label>
                    <input type="text" required class="form-control" name="phone" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Your address</label>
                    <input type="text" required class="form-control" name="address" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="method">Choose Payment Method</label>
                    <select id="method" onchange="selectMethodPayment()" class="form-control" name="method">
                        <option value="nomal">Pay Directly </option>
                        <option value="pnv21pay">PNV21Pay Wallet</option>
                    </select>
                </div>
                <div id="display-wallet"  class="form-group">
                    @if ($balance==0)
                    <label for="">Your Balance:  $0</label>
                    @else
                    <label for="">Your Balance:  ${{ number_format($balance) }}</label>
                    @endif
                    <input id="balance" type="number" class="form-control" value="{{ $balance }}" hidden name="balance"  placeholder="">
                </div>
                 <div class="form-group">
                   <label for="">Total Price:</label>
                   @if ($cart->promotionPrice)
                    <h6>${{ $cart->showPromotionPrice() }}</h6>
                   <input type="number"  class="form-control"  id="totalPrice" hidden value="{{ $cart->promotionPrice }}" name="totalPrice" id="" aria-describedby="helpId" placeholder="">
                   @else
                   <h6>${{$cart->showTotalPrice() }}</h6>
                   <input type="number" class="form-control" hidden id="totalPrice" name="totalPrice" value="{{ $cart->totalPrice }}" id="" aria-describedby="helpId" placeholder="">
                   @endif
                </div>
                <div id="not"  style="display: none" class="form-group">
                  <label for="" style="color: red">Your account does not have enough money!</label>
                </div>
                </div>
            </div>
          <div class="modal-footer">
            <button type="submit" id="submit-order" class="btn btn-danger">Order</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <script>
        function selectMethodPayment(){
        var method=document.getElementById('method').value;
        if(method=="pnv21pay"){
            var balance=document.getElementById('balance').value;
            var totalPrice=document.getElementById('totalPrice').value;
            if(balance-totalPrice>=0){
                document.getElementById('submit-order').disabled=false;
                document.getElementById('not').style.display="none";
            }else{
                document.getElementById('submit-order').disabled=true;
                document.getElementById('not').style.display="block";
            }
        }else{
            document.getElementById('submit-order').disabled=false;
            document.getElementById('not').style.display="none";
        }
        }
    </script>



