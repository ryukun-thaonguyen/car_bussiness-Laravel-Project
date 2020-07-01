<section class="car spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="car__filter__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="car__filter__option__item">
                                <h6>Show On Page</h6>
                                <select>
                                    <option value="">9 Car</option>
                                    <option value="">15 Car</option>
                                    <option value="">20 Car</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="car__filter__option__item car__filter__option__item--right">
                                <h6>Sort By</h6>
                                <select>
                                    <option value="">Price: Highest Fist</option>
                                    <option value="">Price: Lowest Fist</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($orders as $key=>$value)
                    <div class="col-lg-4 col-md-4">
                        <div class="car__item">
                            <div class="car__item__pic__slider owl-carousel">
                                @foreach (json_decode($value->image) as $image )
                                <img style="width: 424px;height:200px" src="{{ $image }}" alt="">
                                @endforeach
                            </div>
                            <div class="car__item__text">
                                <div class="car__item__text__inner">
                                    <div class="label-date">Order's day: {{ $value->date }}</div>
                                    <h5><a href="">{{ $value->name }}</a></h5>
                                    <ul>
                                        <li>Quantity order: <span>{{ number_format($value->quantity) }}</span>@if($value->type=='car')Cars @else Motos @endif</li>
                                        <li><span>{{ $value->type }}</span></li>
                                    </ul>
                                    <h6>Order To: {{ $value->address }}</h6>

                                </div>
                                <div class="car__item__price">
                                    <a href="" class="car-option">Edit Info</a>
                                    <h6>Total Price: ${{ number_format($value->price) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination__option">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><span class="arrow_carrot-2right"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
