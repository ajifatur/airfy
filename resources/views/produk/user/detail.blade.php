@extends('template/user/template')

@section('title', $produk->nama_produk.' - Produk')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="/shop">shop</a></li>
            <li> {{ $produk->nama_produk }}</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
<!--                     <ol class="carousel-indicators">
                        @foreach($produk->gambar_produk as $key=>$data)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol> -->
                    <div class="carousel-inner">
                        @foreach($produk->gambar_produk as $key=>$data)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('assets/images/produk/'.$data) }}" class="d-block w-100" alt="...">
                        </div>
                        @endforeach
                    </div>
                    @if(count($produk->gambar_produk)>1)
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{ $produk->nama_produk }}</h3>
                    <div class="details-price">
                        <span>Rp. {{ number_format($produk->harga,0,',',',') }}</span>
                    </div>
                    <p>{!! nl2br($produk->deskripsi_produk) !!}</p>
                    <p class="mb-1">STOK TERSEDIA : <strong>{{ $produk->stok }}</strong></p>
                    <div class="quickview-plus-minus">
                        <div class="cart-plus-minus">
                            <input type="number" value="1" data-stok="{{ $produk->stok }}" name="qtybutton" id="q" class="cart-plus-minus-box">
                        </div>
                        <div class="quickview-btn-wishlist ml-3">
                            <a class="btn-hover btn-wishlist" href="#" title="Tambahkan ke Wishlist"><i class="pe-7s-like"></i></a>
                        </div>
                    </div>
                    <div class="quickview-btn-cart mx-0 mt-3">
                        <a class="btn-hover-black w-100 text-center btn-keranjang" href="#">Tambahkan ke Keranjang</a>
                    </div>
                    <input type="hidden" name="produk" id="p" value="{{ $produk->id_produk }}">
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Kategori :</li>
                            @foreach($kategori as $data)
                            <li><a href="/shop/{{ $data->permalink_kategori }}">{{ $data->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-extra')

<script type="text/javascript">
    // Mengatur kuantitas...
    $(document).on("change", "#q", function(){
        var p = $("#p").val();
        var q = $("#q").val();
        var stok = $(this).data("stok");
        var product_quantity = q >= 1 ? q > stok ? stok : q : 1;
        $("#q").val(product_quantity);
    });

    // Menambah kuantitas...
    $(document).on("click", ".inc", function(){
        var q = $("#q").val();
        var stok = $("#q").data("stok");
        q++;
        var product_quantity = q >= 1 ? q > stok ? stok : q : 1;
        $("#q").val(product_quantity);
    });

    // Mengurangi kuantitas...
    $(document).on("click", ".dec", function(){
        var q = $("#q").val();
        var stok = $("#q").data("stok");
        q--;
        var product_quantity = q >= 1 ? q > stok ? stok : q : 1;
        $("#q").val(product_quantity);
    });

    // Menambahkan ke wishlist...
    $(document).on("click", ".btn-wishlist", function(e){
        e.preventDefault();
        var p = $("#p").val();
        var q = $("#q").val();
        window.location.href = "/wishlist/tambah/"+p+"/"+q;
    });

    // Menambahkan ke keranjang...
    $(document).on("click", ".btn-keranjang", function(e){
        e.preventDefault();
        var p = $("#p").val();
        var q = $("#q").val();
        window.location.href = "/keranjang/tambah/"+p+"/"+q;
    });
</script>

@endsection

@section('css-extra')

<style type="text/css">
    .carousel-control-prev:hover {background-image: linear-gradient(to left, transparent, rgba(0,0,0,.5));}
    .carousel-control-next:hover {background-image: linear-gradient(to right, transparent, rgba(0,0,0,.5));}
    .details-price > span {color: #b5b5b5; font-size: 18px;}
    .cart-plus-minus {width: 120px;}
    input.cart-plus-minus-box {width: 70px;}
</style>

@endsection