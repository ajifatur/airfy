        <!-- header start -->
        <header>
            <div class="header-top-furniture wrapper-padding-2 res-header-sm">
                <div class="container-fluid">
                    <div class="header-bottom-wrapper">
                        <div class="logo-2 furniture-logo ptb-30">
                            <a href="/">
                                <!-- <img src="{{ asset('templates/ezone/assets/img/logo/2.png') }}" alt=""> -->
                                <img src="{{ asset('assets/images/logo/'.$var_kontak->logo_perusahaan) }}" height="45px" alt="">
                            </a>
                        </div>
                        <div class="menu-style-2 furniture-menu menu-hover">
                            <nav>
                                <ul>
                                    <li><a href="/">home</a></li>
                                    <li><a href="/shop">shop</a></li>
                                    <li><a href="/kontak">kontak</a></li>
                                    <li><a href="/tentang-kami">tentang kami</a></li>
                                </ul>
                            </nav>
                        </div>
<!--                         <div class="header-cart">
                            <a class="icon-cart-furniture" href="#">
                                <i class="ti-shopping-cart"></i>
                                <span class="shop-count-furniture green">02</span>
                            </a>
                            <ul class="cart-dropdown">
                                <li class="single-product-cart">
                                    <div class="cart-img">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/cart/1.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="cart-title">
                                        <h5><a href="#"> Bits Headphone</a></h5>
                                        <h6><a href="#">Black</a></h6>
                                        <span>$80.00 x 1</span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="#"><i class="ti-trash"></i></a>
                                    </div>
                                </li>
                                <li class="cart-space">
                                    <div class="cart-sub">
                                        <h4>Subtotal</h4>
                                    </div>
                                    <div class="cart-price">
                                        <h4>$240.00</h4>
                                    </div>
                                </li>
                                <li class="cart-btn-wrapper">
                                    <a class="cart-btn btn-hover" href="#">view cart</a>
                                    <a class="cart-btn btn-hover" href="#">checkout</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <li><a href="/">home</a></li>
                                        <li><a href="/shop">shop</a></li>
                                        <li><a href="/kontak">kontak</a></li>
                                        <li><a href="/bantuan">bantuan</a></li>
<!--                                         <li><a href="#">pages</a>
                                            <ul>
                                                <li><a href="about-us.html">about us</a></li>
                                                <li><a href="menu-list.html">menu list</a></li>
                                                <li><a href="login.html">login</a></li>
                                                <li><a href="register.html">register</a></li>
                                                <li><a href="cart.html">cart page</a></li>
                                                <li><a href="checkout.html">checkout</a></li>
                                                <li><a href="wishlist.html">wishlist</a></li>
                                                <li><a href="contact.html">contact</a></li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </nav>							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
                <div class="container-fluid">
                    <div class="furniture-bottom-wrapper">
                        @if(Auth::guest())
                        <div class="furniture-login">
                            <ul>
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Daftar</a></li>
                            </ul>
                        </div>
                        @else
                            @if(Auth::user()->role == 1)
                            <div class="furniture-login">
                                <ul>
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/register">Daftar</a></li>
                                </ul>
                            </div>
                            @elseif(Auth::user()->role == 2)
                            <div class="furniture-login">
                                <ul>
                                    <li><a href="/profil">Profil</a></li>
                                    <li><a href="/pembelian">Pembelian</a></li>
                                    <li>
                                        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout').submit();">Keluar</a>
                                        <form id="logout" method="post" action="/logout" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        @endif
                        <div class="furniture-search">
                            <form action="#">
                                <input placeholder="" type="text" disabled>
                                <button class="d-none">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="furniture-wishlist">
                            <ul>
                                <li><a href="/wishlist"><i class="ti-heart"></i> Wishlist</a></li>
                                <li><a href="/keranjang"><i class="ti-shopping-cart"></i> Keranjang</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->
        <style type="text/css">
            @media (min-width: 992px) {.menu-style-2.furniture-menu nav > ul > li {margin: 0!important; margin-left: 30px!important;}}
            @media (min-width: 992px) {.menu-style-2.furniture-menu nav > ul > li:first-child {margin-left: 0!important;}}
        </style>