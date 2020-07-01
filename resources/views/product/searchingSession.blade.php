<section class="car spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="car__sidebar">
                    <div class="car__search">
                        <h5>Search Cars/Motos</h5>
                        <form action="product" method="post">
                            @csrf
                            <input type="text" hidden value="searchText" name="option">
                            <input type="text" name="textSearch" placeholder="Search..."
                            value="@if(isset($textSearch)){{ $textSearch }} @endif">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="car__filter">
                        <h5>Filter</h5>
                        <form action="product" method="POST">
                            @csrf
                            <input type="text" hidden value="searchFilter" name="option">
                            <label for="">Type</label>
                            <select name="type">
                                <option value="">
                                    @if (isset($typeSearch))
                                        @if($typeSearch!='')
                                           {{ $typeSearch }}
                                        @endif
                                    @else
                                     Select type
                                    @endif
                                </option>
                                <option value="">Select All</option>
                                <option value="car">Car</option>
                                <option value="moto">Moto </option>
                            </select>
                            <label for="">Brand</label>
                            <select name="brand">
                                <option value="">
                                    @if (isset($brandSearch))
                                        @if($brandSearch!='')
                                           {{ $brandSearch }}
                                        @endif
                                    @else
                                     Select brand
                                    @endif
                                </option>
                                <option value="">Select All</option>
                                @foreach ($brands as $value)
                                    <option value="{{ $value->brand }}">{{ $value->brand }}</option>
                                @endforeach

                            </select>
                            <label for="">Year</label>
                            <select name="year">
                                <option value="">
                                    @if (isset($yearSearch))
                                        @if($yearSearch!='')
                                           {{ $yearSearch }}
                                        @endif
                                    @else
                                     Select year
                                    @endif
                                </option>
                                <option value="">Select All</option>
                                @foreach ($years as $value)
                                    <option value="{{ $value->year }}">{{ $value->year }}</option>
                                @endforeach
                            </select>
                            <label for="">Mileage</label>
                            <select name="mileage">
                                <option value="">
                                    @if (isset($mileageSearch))
                                        @if($mileageSearch!='')
                                           {{ $mileageSearch }}
                                        @endif
                                    @else
                                     Select mileage
                                    @endif
                                </option>
                                <option value="">Select All</option>
                                @foreach ($mileages as $value)
                                    <option value="{{ $value->mileage }}">{{ $value->mileage }}</option>
                                @endforeach
                            </select>
                            <div class="filter-price">
                                <p>Price:</p>
                                <div class="price-range-wrap">
                                    <div class="filter-price-range"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" value="
                                            @if (isset($fillterAmoutSearch))
                                            @if($fillterAmoutSearch!='')
                                            {{ $fillterAmoutSearch}}
                                            @endif
                                            @else
                                            [1,1000000]
                                            @endif
                                            "
                                             id="filterAmount" name="filterAmount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="car__filter__btn">
                                <button type="submit" name="searchFilter" class="site-btn">Reset Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="car__filter__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="car__filter__option__item">
                                <h6>Show On Page</h6>
                                <select>
                                    <option value="9">9 Products</option>
                                    <option value="12">12 Products</option>
                                    <option value="15">15 Products</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="car__filter__option__item car__filter__option__item--right">
                                <select name="sorting" id="sorting">
                                    <option value=""><a  id="" class="btn btn-primary"  role="button">Sort By Price</a></option>
                                    <option value="high_first"><button type="button" name="high_first" class="btn btn-primary">Price: Highest Fist</button></option>
                                    <option value="low_first"><button type="button" name="low_first"  class="btn btn-primary">Price: Lowest Fist</button></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="data">
                    @if(count($products)==0)
                     <span>We don't have the product you need, try searching for another product</span>
                    @else
                    @foreach ($products as $key=>$value)
                    <div class="col-lg-4 col-md-4" data-category-group="{{ $value->price }}">
                        <div class="car__item">
                            <div class="car__item__pic__slider owl-carousel">
                                @foreach (json_decode($value->image) as $image )
                                <img style="width: 424px;height:200px" src="{{ $image }}" alt="">
                                @endforeach
                            </div>
                            <div class="car__item__text">
                                <div class="car__item__text__inner">
                                    <div class="label-date">Model {{ $value->year }}</div>
                                    <h5><a href="/product/{{ $value->slug }}">{{ $value->name }}</a></h5>
                                    <h6 >Price:   <span style="color: red">${{ number_format($value->price) }}</span></h6>
                                    <ul>
                                        <li><span>{{ number_format($value->mileage) }}</span> mi</li>
                                        <li>{{ $value->brand }}</li>
                                        <li><span>{{ $value->type }}</span></li>
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
                    @endif
                </div>
                {{-- <div class="pagination__option"> --}}
                    {{-- <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a> --}}
                    {{ $products->links('pagination.homePagination') }}
                    {{-- <a href="#"><span class="arrow_carrot-2right"></span></a> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>
<script>

    function lowToHigh(a,b) {
        if(a.dataset.categoryGroup < b.dataset.categoryGroup) return -1;
        if(a.dataset.categoryGroup > b.dataset.categoryGroup) return 1;
    }
    function highToLow(a,b){
        if(a.dataset.categoryGroup > b.dataset.categoryGroup) return -1;
        if(a.dataset.categoryGroup < b.dataset.categoryGroup) return 1;
    }
    var sort=document.getElementById("sorting");
    sort.onchange = () =>{
    if(sort.value=="high_first"){
        var categoryItems = document.querySelectorAll("[data-category-group]");
        var categoryItemsArray = Array.from(categoryItems);
        let sorted = categoryItemsArray.sort(highToLow);
        sorted.forEach(e => document.querySelector("#data").appendChild(e));
    }
    if(sort.value=="low_first"){
            var categoryItems = document.querySelectorAll("[data-category-group]");
            var categoryItemsArray = Array.from(categoryItems);
            let sorted = categoryItemsArray.sort(lowToHigh);
            sorted.forEach(e => document.querySelector("#data").appendChild(e));
        }

}
</script>
