<section class="car spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <h2>PN21Pay Wallet</h2>
                @if ($user->balance)
                <h4>Your Balance: $ {{ number_format($user->balance->balance) }}</h4>
                <form class="form-discount" action="profile/balance/add" method="post">
                    @csrf
                    <input class="input-check" name="balance" type="number" id="inputBalance" min="1" placeholder="Add money to your wallet">
                    <span style="color: white;height: 100%;">
                        <button   style="border: none;width: 29%"  id="submitBalance" class="primary-btn" role="button" type="submit">Add</button>
                    </span>
                </form>
                @else
                  <h4>Your Balance: $0</h4>
                  <form class="form-discount" action="profile/balance/add" method="post">
                    @csrf
                    <input class="input-check" name="balance" id="inputBalance" type="text" placeholder="Add money to your wallet">
                    <span style="color: white;height: 100%;">
                        <button  style="border: none;width: 29%" id="submitBalance" class="primary-btn" role="button" type="submit">Add</button>
                    </span>
                </form>
                @endif
             </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <table class="table table-light">
                    @if (!count($orders))
                    <h5 style="text-align: center">You haven't ordered any products yet</h5>
                     <h6 style="text-align: center" ><a href="/product" >Lets buying</a></h6>
                   @else
                    <h5 style="margin-left: 30px;color: black;font-weight: 900;color: rgb(201, 73, 22)">Your odder list has {{ count($orders) }} orders</h5>
                    <thead>
                        <th>Product</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($orders); $i++)
                        <tr class="cart-tr">
                            <td class="car-filter"  >
                                <ul>
                                    @foreach ($orders[$i]['product'] as $key=> $p)
                                    <li>
                                        <h5>Product: <span style="font-weight: 400;color: rgb(20, 214, 46)">{{ $p->name }}</span></h5>
                                        <h6>Quantity: {{ $orders[$i]['quantity'][$key] }}</h6>
                                        <h6>Price: ${{ number_format($orders[$i]['quantity'][$key]*$p->price) }}</h6>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if ($orders[$i]['promote']=="")
                                <h6>Promotion code: no using</h6>
                                @else
                                <h6>Promotion code: {{ $orders[$i]['promote'] }}</h6>
                                @endif
                                 <h6>Total Price: ${{ number_format($orders[$i]['totalPrice']) }}</h6>
                            </td>
                            <td>
                                <h5>{{ $orders[$i]['address'] }}</h5>
                            </td>
                            <td>
                                <h6>{{ $orders[$i]['payment'] }}</h6>
                            </td>
                            <td>
                               <h6>{{$orders[$i]['status']}}</h6>
                            </td>
                            <td class="qty-cart">
                                 <a href="/order/view/{{ $orders[$i]['id'] }}" class="qty-trash">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        @endfor
                        @endif
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</section>
<script>

    var auto=setInterval(function(){
        var balance=document.getElementById('inputBalance').value;
        if(!balance){
        document.getElementById('submitBalance').hidden=true;
        }else{
            document.getElementById('submitBalance').hidden=false;
        }

    },10);
</script>
