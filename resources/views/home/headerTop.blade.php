<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <ul class="header__top__widget">
                    <li>
                        <i class="fa fa-bell" aria-hidden="true"></i>
                    </li>
                    <li></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="header__top__right">
                    <div class="header__top__phone">
                        <span> @if(Auth::check())
                            <i class="fa fa-envelope-o"></i>
                                {{ Auth::user()->email }}
                                @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

