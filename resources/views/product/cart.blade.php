<section class="car spad">
    <div class="container-fluid">
        <table class="table table-light">
            <tbody>
                @if (session('notification'))
                    <div style="text-align: center" class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif
                @if (!count($cart->items))
                   <h5 style="text-align: center">Your cart does'n have any products</h5>
                    <h6 style="text-align: center" ><a href="/product" >Lets buying</a></h6>
                @else
                 <h5 style="margin-left: 30px;color: black;font-weight: 900;color: rgb(201, 73, 22)">Your cart has {{ count($cart->items) }} products</h5>
                <tr class="cart-tr">
                    <td class="car-filter" style="width: 300px"  >
                        <div style="width: 300px" >
                        <div class="car__item">
                            <div class="car__item__pic__slider owl-carousel">
                                @foreach (json_decode($products[0]->image) as $image )
                                <img src="{{ $image }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </td>
                    <td>
                        <h5>{{ $products[0]->name }}</h5>
                        <h6>Brand: <span >{{ $products[0]->brand }}</span></h6>
                        <h6>Model: {{ $products[0]->year }}</h6>
                        <h6>Mileage: {{ $products[0]->mileage }}</h6>
                    </td>
                    <td><h6>$ {{ number_format($products[0]->price*$cart->items[0]["quantity"]) }}</h6></td>
                    <td class="qty-cart">
                        <a href="cart/decr/{{ $products[0]->id }}" type="button" class="qty-change">-</a>
                        <input name="quantity" class="qty-input" type="tel" value="{{
                         $cart->items[0]["quantity"]
                        }}" disabled>
                        <a href="cart/incr/{{ $products[0]->id }}" type="button"  class="qty-change">+</a>
                         <a href="/cart/delete/{{ $products[0]->id }}" class="qty-trash">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td  class="cart-td-right" >

                        <h4>Provisional: $ {{ $cart->showTotalPrice() }}</h4>


                        <form class="form-discount" action="" method="post">
                            @csrf
                            <input class="input-check" type="text" name="promote" placeholder="Discount code">
                            <span style="color: white;height: 100%;">
                                <button style="border: none;width: 29%" class="primary-btn" role="button" type="submit">Check</button>
                            </span>
                        </form>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <ul style="list-style: none;">
                            @if (isset($promotions)&& $cart->promote=="")
                                <h6>Code suggestions for you: </h6>
                                @foreach ($promotions as $p)
                                    <li style="color: rgb(15, 233, 51)"> {{ $p->name }}<span style="color: red">({{ $p->discount }}%)</span></li>
                                @endforeach
                             @endif
                        </ul>
                        @if ($cart->promote!="")
                        <h6 style="color: rgb(15, 233, 51)">Using: {{ $cart->promote }}
                            <span style="color: red">(-{{ $cart->promoteValue }}%)</span></h6>
                        <h6>Saving: ${{ number_format($cart->totalPrice-$cart->promotionPrice) }}</h6>
                        <button id="viewall" onclick="viewall()" style="margin-top: 10px" class="btn btn-success" role="button" type="submit">View all available code for you</button>
                        <div id="more" style="display: none">
                            <ul style="list-style: none;">
                                   @if (isset($promotions))
                                    @foreach ($promotions as $p)
                                    <li style="color: rgb(15, 233, 51)"> {{ $p->name }}<span style="color: red">({{ $p->discount }}%)</span></li>
                                        @endforeach
                                   @endif
                            </ul>
                        </div>
                        <hr>
                        <h4>Total Price: $ {{ $cart->showPromotionPrice()  }}</h4>
                        @else
                        <h4>Total Price: $ {{ $cart->showTotalPrice() }}</h4>
                         @endif

                        <h6 style="color: rgb(23, 143, 103)">Including taxes and fees</h6>
                        @if (Auth::check())
                        <a type="button"  data-toggle="modal" data-target="#orderModel" style="width: 100%;margin-top: 30px;text-align: center;color: white" class="primary-btn">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            Order
                        </a>
                        @else
                        <a href="/login" style="width: 100%;margin-top: 30px;text-align: center" class="primary-btn">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            Login to order
                        </a>
                        @endif

                    </td>
                </tr>
                @for ($i = 1; $i < count($cart->items); $i++)
                   <tr class="cart-tr">
                    <td class="car-filter" style="width: 300px"  >
                        <div style="width: 300px" >
                        <div class="car__item">
                            <div class="car__item__pic__slider owl-carousel">
                                @foreach (json_decode($products[$i]->image) as $image )
                                <img src="{{ $image }}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </td>
                    <td>
                        <h5>{{ $products[$i]->name }}</h5>
                        <h6>Brand: <span >{{ $products[$i]->brand }}</span></h6>
                        <h6>Model: {{ $products[$i]->year }}</h6>
                        <h6>Mileage: {{ $products[$i]->mileage }}</h6>
                    </td>
                    <td><h6>$ {{ number_format($products[$i]->price*$cart->items[$i]["quantity"]) }}</h6></td>
                    <td class="qty-cart">
                        <a href="cart/decr/{{ $products[$i]->id }}" type="button" class="qty-change">-</a>
                        <input name="quantity" class="qty-input" type="tel" value="{{
                         $cart->items[$i]["quantity"]
                        }}" disabled>
                        <a href="cart/incr/{{ $products[$i]->id }}" type="button"  class="qty-change">+</a>
                        <a href="/cart/delete/{{ $products[0]->id }}" class="qty-trash">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td  class="cart-td-right" >
                    </td>
                   </tr>
                @endfor
                @endif
            </tbody>
        </table>
    </div>
</section>

<script>
    function viewall(){
        document.getElementById('more').style.display="block";
    }
</script>
