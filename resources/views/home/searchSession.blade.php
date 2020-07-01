<section class="hero spad set-bg" data-setbg="img/hero-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero__text">
                    <div class="hero__text__title">
                        <span>FIND YOUR DREAM CAR</span>
                        <h2>Lambogini Avendor </h2>
                    </div>
                    <div class="hero__text__price">
                        <div class="car-model">Model 2020</div>
                        <h2>$30,000<span></span></h2>
                    </div>
                    <a href="#" class="primary-btn"><img src="img/wheel.png" alt="">Buy</a>
                    <a href="#" class="primary-btn more-btn">Learn More</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero__tab">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="hero__tab__form">
                                <h2>Find Your Dream Car</h2>
                                <form action="/product" method="POST">
                                    @csrf
                                    <div class="select-list">
                                        <div class="select-list-item">
                                            <p>Select Type</p>
                                            <select name="type">
                                                <option value="">
                                                     Select type
                                                </option>
                                                <option value="car">Car</option>
                                                <option value="moto">Moto </option>
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Brand</p>
                                            <select name="brand">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $value)
                                                 <option value="{{ $value->brand }}">{{ $value->brand }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Year</p>
                                            <select>
                                                <option value="">Select Model</option>
                                                @foreach ($years as $value)
                                                 <option value="{{ $value->year }}">{{ $value->year }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Mileage</p>
                                            <select>
                                                <option value="">Select Mileage</option>
                                                @foreach ($mileages as $value)
                                                 <option value="{{ $value->mileage }}">{{ $value->mileage }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <p>Price($) in:</p>
                                        <div class="price-range-wrap">
                                            <div class="price-range"></div>
                                            <div class="range-slider">
                                                <div class="price-input">
                                                    <input type="text" name="filterAmount" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-btn">Searching</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
