<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="HVAC Template">
    <meta name="keywords" content="HVAC, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KunCar</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link rel="stylesheet" href="../css/star-rating.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="offcanvas-menu-overlay"></div>

    @include('home.header')
    {{-- @if (Auth::check()) --}}
    @include('product.rating')
    {{-- @endif --}}

    <div class="breadcrumb-option set-bg" data-setbg="../img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product[0]->name }} {{ $product[0]->year }}</h2>
                        <div class="breadcrumb__links">
                            <a href="/"><i class="fa fa-home"></i> Home</a>
                            <a href="../product">Cars/Motos</a>
                            <span>{{ $product[0]->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="car-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="car__details__pic">
                        <div class="car__details__pic__large">
                            <img class="car-big-img" src="../{{json_decode($product[0]->image)[0]}}" alt="">
                        </div>
                        <div class="car-thumbs">
                            <div class="car-thumbs-track car__thumb__slider owl-carousel">
                                @foreach( json_decode($product[0]->image) as $image)
                                <div class="ct" data-imgbigurl="../{{ $image }}">
                                    <img src="../{{ $image }}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

@include('product.comment')
                </div>
                <div class="col-lg-3">
                    <div class="car__details__sidebar">
                        <div class="car__details__sidebar__model">
                            <ul>
                                <li><h4>{{ $product[0]->name }}</h4></li>
                                <li style="color: rgb(198, 201, 10)" >
                                    @for ($i=1;$i<=$product[0]->rate;$i++)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                    @if ($product[0]->rate-$i+1>=0.5)
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        {{-- {{ $i+=1 }} --}}
                                    @endif
                                    @for ($k =$i ; $k <=5 ; $k++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                    ({{ $userRated }} users rated)
                                </li>
                                <li>Model <span>{{ $product[0]->year }}</span></li>
                                <li>Brand <span>{{ $product[0]->brand }}</span></li>
                                <li>Mileage <span>{{ number_format($product[0]->mileage) }}</span></li>
                                <li>Price <span>${{ number_format($product[0]->price) }}</span></li>
                            </ul>

                            @if (Auth::check())
                            <a href="#" data-toggle="modal" data-target="#rating" class="primary-btn" style="background-color: rgb(138, 138, 243)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Rate this product</a>
                            @else
                            <a href="/login"  class="primary-btn" style="background-color: rgb(138, 138, 243)">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i> Login to rate this product</a>
                            @endif
                        </div>
                        <div class="car__details__sidebar__payment">

                            <a href="/add-to-cart/{{ $product[0]->id }}" style="color: white" class="primary-btn"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.footerSession')


    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery/jquery.nice-select.min.js"></script>
    <script src="../jquery/jquery-ui.min.js"></script>
    <script src="../jquery/jquery.magnific-popup.min.js"></script>
    <script src="../jquery/jquery.slicknav.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/star-rating.js"></script>
    <script>
        jQuery(document).ready(function () {
            var $inp = $('#rating-input');

            $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'lg',
                showClear: false
            });

            $('#btn-rating-input').on('click', function () {
                $inp.rating('refresh', {
                    showClear: true,
                    disabled: !$inp.attr('disabled')
                });
            });


            $('.btn-danger').on('click', function () {
                $("#kartik").rating('destroy');
            });

            $('.btn-success').on('click', function () {
                $("#kartik").rating('create');
            });

            $inp.on('rating.change', function () {
                alert($('#rating-input').val());
            });


            $('.rb-rating').rating({
                'showCaption': true,
                'stars': '3',
                'min': '0',
                'max': '3',
                'step': '1',
                'size': 'xs',
                'starCaptions': {0: 'status:nix', 1: 'status:wackelt', 2: 'status:geht', 3: 'status:laeuft'}
            });
            $("#input-21c").rating({
                min: 0, max: 8, step: 0.5, size: "xl", stars: "8"
            });
        });
    </script>
</body>

</html>
