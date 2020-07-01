    <!-- Header Section Begin -->
    <header class="header">
        @include('home.headerTop')
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img style="height: 60px;width:100px" src="../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav">
                        <nav class="header__menu">
                            <ul>
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="../product">Cars/Motos</a></li>
                                <li><a href="./blog">Blog</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="./about">About Us</a></li>
                                        <li><a href="./car-details.html">Car Details</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./about">About</a></li>
                                <li><a href="./contact">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header__nav__widget">
                            <div class="header__nav__widget__btn">
                                <a href="#"><i class="fa fa-cart-plus"></i></a>
                                <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
                            </div>
                            @if(Auth::check())
                            <a href="/logout" class="primary-btn">Logout</a>
                            @else
                            <a href="/login" class="primary-btn">Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </header>
