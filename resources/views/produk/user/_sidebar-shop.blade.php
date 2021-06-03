            <div class="col-lg-3">
                <div class="shop-sidebar mr-50">
                    <div class="sidebar-widget mb-50">
                        <h3 class="sidebar-title">Pencarian</h3>
                        <div class="sidebar-search">
                            <form action="/shop/pencarian" method="get">
                                <input placeholder="Cari produk..." type="text" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}">
                                <button><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
<!--                     <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">Filter Harga</h3>
                        <div class="price_filter">
                            <div id="slider-range"></div>
                            <div class="price_slider_amount">
                                <div class="label-input">
                                    <label>harga : </label>
                                    <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                </div>
                                <button type="button" style="cursor: pointer;">Filter</button> 
                            </div>
                        </div>
                    </div> -->
                    <div class="sidebar-widget mb-45">
                        <h3 class="sidebar-title">Kategori</h3>
                        <div class="sidebar-categories">
                            <ul>
                                @foreach($kategori as $data)
                                <li><a href="/shop/{{ $data->permalink_kategori }}"><i class="ti-angle-right"></i> {{ $data->nama_kategori }}</a></li>
                                <!-- <li><a href="/shop/{{ $data->permalink_kategori }}">{{ $data->nama_kategori }} <span>{{ $data->id_kategori }}</span></a></li> -->
                                @endforeach
                            </ul>
                        </div>
                    </div>
<!--                     <div class="sidebar-widget mb-50">
                        <h3 class="sidebar-title">Top Produk</h3>
                        <div class="sidebar-top-rated-all">
                            <div class="sidebar-top-rated mb-30">
                                <div class="single-top-rated">
                                    <div class="top-rated-img">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/product/sidebar-product/1.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="top-rated-text">
                                        <h4><a href="#">Flying Drone</a></h4>
                                        <div class="top-rated-rating">
                                            <ul>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                            </ul>
                                        </div>
                                        <span>$140.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-top-rated mb-30">
                                <div class="single-top-rated">
                                    <div class="top-rated-img">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/product/sidebar-product/2.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="top-rated-text">
                                        <h4><a href="#">Flying Drone</a></h4>
                                        <div class="top-rated-rating">
                                            <ul>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                            </ul>
                                        </div>
                                        <span>$140.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-top-rated mb-30">
                                <div class="single-top-rated">
                                    <div class="top-rated-img">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/product/sidebar-product/3.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="top-rated-text">
                                        <h4><a href="#">Flying Drone</a></h4>
                                        <div class="top-rated-rating">
                                            <ul>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                                <li><i class="pe-7s-star"></i></li>
                                            </ul>
                                        </div>
                                        <span>$140.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>