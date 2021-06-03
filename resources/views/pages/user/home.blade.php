@extends('template/user/template')

@section('title', 'Home')

@section('content')

<div class="slider-area">
    <div class="slider-active owl-carousel">
        <div class="single-slider-4 bg-img" style="background-image: url({{ asset('assets/images/breadcrumb/2.jpg') }})">
            <div class="w-100" style="background-color: rgba(0,0,0,.6); padding: 100px 0;">
                <div class="row">
                    <div class="ml-auto col-lg-6">
                        <div class="furniture-content fadeinup-animated">
                            <h2 class="animated">Koleksi  <br>Berkualitas.</h2>
                            <p class="animated">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <a class="furniture-slider-btn btn-hover animated" href="/shop">Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-slider-4 bg-img" style="background-image: url({{ asset('assets/images/breadcrumb/3.jpg') }})">
            <div class="w-100" style="background-color: rgba(0,0,0,.6); padding: 100px 0;">
                <div class="row">
                    <div class="ml-auto col-lg-6">
                        <div class="furniture-content fadeinup-animated">
                            <h2 class="animated">Koleksi  <br>Nyaman.</h2>
                            <p class="animated">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <a class="furniture-slider-btn btn-hover animated" href="/shop">Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- services area start -->
<div class="services-area wrapper-padding-4 gray-bg pt-120 pb-80">
    <div class="container-fluid">
        <div class="services-wrapper">
            <div class="col-md-4 text-center service-content">
                <img src="{{ asset('templates/ezone/assets/img/icon-img/26.png') }}" alt="">
                <h4 class="mt-3">Gratis Ongkir</h4>
                <p>Contrary to popular belief, Lorem Ipsum is random text. </p>
            </div>
            <div class="col-md-4 text-center service-content mt-5 mt-md-0">
                <img src="{{ asset('templates/ezone/assets/img/icon-img/27.png') }}" alt="">
                <h4 class="mt-3">Pelayanan 24/7</h4>
                <p>Contrary to popular belief, Lorem Ipsum is random text. </p>
            </div>
            <div class="col-md-4 text-center service-content mt-5 mt-md-0">
                <img src="{{ asset('templates/ezone/assets/img/icon-img/28.png') }}" alt="">
                <h4 class="mt-3">Pembayaran Aman</h4>
                <p>Contrary to popular belief, Lorem Ipsum is random text. </p>
            </div>
        </div>
    </div>
</div>
<!-- services area end -->
<!-- product area start -->
<div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
    <div class="container-fluid">
        <div class="section-title-6 text-center mb-50">
            <h2>Produk</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
        </div>
        <div class="product-style mb-5">
            <div class="owl-carousel" id="list-produk">
                @foreach($produk as $data)
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="#">
                            <!-- <img src="{{ asset('templates/ezone/assets/img/product/furniture/1.jpg') }}" alt=""> -->
                            <img src="{{ asset('assets/images/produk/'.$data->gambar_produk[rand(0,(count($data->gambar_produk)-1))]) }}" alt="" style="height: 250px;">
                        </a>
                        <div class="product-action">
                            <a class="animate-left" title="Wishlist" href="/wishlist/tambah/{{ $data->id_produk }}/1">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a class="animate-top" title="Tambahkan ke Keranjang" href="/keranjang/tambah/{{ $data->id_produk }}/1">
                                <i class="pe-7s-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="funiture-product-content text-center">
                        <h4><a href="/produk/{{ $data->id_produk }}">{{ $data->nama_produk }}</a></h4>
                        <span>Rp. {{ number_format($data->harga,0,',',',') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="view-all-product text-center">
            <a href="/shop">Lihat Semua Produk</a>
        </div>
    </div>
</div>
<!-- product area end -->
<!-- discount area start -->
<!-- <div class="discount-area gray-bg pt-70 pb-120">
    <div class="container">
        <div class="row">
            <div class="ml-auto col-lg-7">
                <div class="discount-img pl-70">
                    <img src="{{ asset('templates/ezone/assets/img/banner/28.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="discount-details-wrapper">
                    <h5>Verified quality</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <h2>Summer Discount <br>Up to 30%</h2>
                    <p class="discount-peragraph">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <a class="discount-btn btn-hover" href="product-details.html">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- discount area end -->
<!-- testimonials area start -->
<div class="testimonials-area gray-bg pt-120 pb-115">
    <div class="container">
        <div class="testimonials-active owl-carousel">
            <div class="single-testimonial-2 text-center">
                <img src="{{ asset('templates/ezone/assets/img/team/1.png') }}" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                <img src="{{ asset('templates/ezone/assets/img/team/2.png') }}" alt="">
                <h4>tayeb rayed</h4>
                <span>uiux Designer</span>
            </div>
        </div>
    </div>
</div>
<!-- testimonials area end -->

@endsection

@section('js-extra')

<script type="text/javascript">
    // List produk...
    $('#list-produk').owlCarousel({
        loop: true,
        nav: true,
        autoplay: false,
        autoplayTimeout: 5000,
        item: 4,
        margin: 57,
        navText: ['<img src="templates/ezone/assets/img/icon-img/left.png">', '<img src="templates/ezone/assets/img/icon-img/right.png">'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    })
</script>

@endsection

@section('css-extra')

<style type="text/css">
    .furniture-content .animated {color: #f8f9fa;}
    .service-content h4 {font-size: 24px; font-weight: bold;}
    .view-all-product a:before {display: none!important;}
    .view-all-product a:after {display: none!important;}
    .owl-nav .owl-prev img {position: absolute; left: -40px; top: 150px;}
    .owl-nav .owl-next img {position: absolute; right: -40px; top: 150px;}
</style>

@endsection