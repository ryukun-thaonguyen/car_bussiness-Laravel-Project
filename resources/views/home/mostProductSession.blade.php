<section class="car spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Cars/Motos</span>
                    <h2>Best Vehicle Offers</h2>
                </div>
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".moto">Motos</li>
                    <li data-filter=".car">Cars</li>
                </ul>
            </div>
        </div>
        <div class="row car-filter">
            @foreach ($products as $value )
                @if ($value->type=='moto')
                <div class="col-lg-3 col-md-4 col-sm-6 mix moto">
                @else
                <div class="col-lg-3 col-md-4 col-sm-6 mix car">
                @endif
                    <div class="car__item">
                        <div class="car__item__pic__slider owl-carousel">
                            @foreach (json_decode($value->image) as $image )
                            <img src="{{ $image }}" alt="">
                            @endforeach
                        </div>
                        <div class="car__item__text">
                            <div class="car__item__text__inner">
                                <div class="label-date">Model {{ $value->year }}</div>
                                <h5 style="margin-bottom: 0px"><a href="/product/{{ $value->slug }}">{{ $value->name }}</a></h5>
                                <div style="color: rgb(198, 201, 10);">
                                    @for ($i=1;$i<=$value->rate;$i++)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                    @if ($value->rate-$i+1>=0.5)
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        {{-- {{ $i+=1 }} --}}
                                    @endif
                                    @for ($k =$i ; $k <=5 ; $k++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                               </div>
                                <h6 >Price:   <span style="color: red">${{ number_format($value->price) }}</span></h6>
                                <ul>
                                    <li><span>{{ number_format($value->mileage) }}</span> mi</li>
                                    <li>{{ $value->brand }}</li>
                                    <li>{{ $value->type }}</li>
                                </ul>
                            </div>
                            <div class="car__item__price">
                                <a href="/product/{{ $value->id }}" class="car-option sale">Buy now</a>
                                <h6 class="">
                                    <a href="add-to-cart/{{ $value->id }}" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="product" style="float: right">View More <i class="fa fa-long-arrow-right"></i></a>
    </div>
</section>
