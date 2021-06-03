@extends('template/user/template')

@section('title', $kategori_produk->nama_kategori.' - Shop')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="/shop">shop</a></li>
            <li>{{ $kategori_produk->nama_kategori }}</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<div class="shop-page-wrapper shop-page-padding ptb-100">
    <div class="container-fluid">
        <div class="row">
            @include('produk/user/_sidebar-shop')
            <div class="col-lg-9">
                <div class="shop-product-wrapper res-xl res-xl-btn">
                    <div class="shop-bar-area">
                        <div class="shop-bar pb-60">
                            <div class="shop-found-selector">
                                <div class="shop-found">
                                    <p><span>{{ count($produk) }}</span> Produk Ditemukan</p>
                                    <!-- <p><span>{{ count($produk) }}</span> Produk Ditemukan dari <span>50</span></p> -->
                                </div>
                            </div>
                            @if(count($produk) > 0)
                            <div class="shop-filter-tab">
                                <div class="shop-tab nav" role=tablist>
                                    <a class="active" href="#grid-sidebar1" data-toggle="tab" role="tab" aria-selected="false">
                                        <i class="ti-layout-grid4-alt"></i>
                                    </a>
                                    <a href="#grid-sidebar2" data-toggle="tab" role="tab" aria-selected="true">
                                        <i class="ti-menu"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="shop-product-content tab-content">
                            <div id="grid-sidebar1" class="tab-pane fade active show">
                                <div class="row">
                                    @foreach($produk as $data)
                                    <div class="col-lg-6 col-md-6 col-xl-3">
                                        <div class="product-wrapper mb-30">
                                            <div class="product-img border border-secondary">
                                                <a href="/produk/{{ $data->id_produk }}">
                                                    <img src="{{ asset('assets/images/produk/'.$data->gambar_produk[0]) }}" alt="" style="min-height: 200px;">
                                                </a>
                                                <!-- <span>hot</span> -->
                                                <div class="product-action">
                                                    <a class="animate-left" title="Wishlist" href="/wishlist/tambah/{{ $data->id_produk }}/1">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                    <a class="animate-right" title="Tambahkan ke Keranjang" href="/keranjang/tambah/{{ $data->id_produk }}/1">
                                                        <i class="pe-7s-cart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <span class="mb-2">Rp. {{ number_format($data->harga,0,',',',') }}</span>
                                                <h4><a href="/produk/{{ $data->id_produk }}">{{ $data->nama_produk }}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="grid-sidebar2" class="tab-pane fade">
                                <div class="row">
                                    @foreach($produk as $data)
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                            <div class="product-img list-img-width border border-secondary">
                                                <a href="/produk/{{ $data->id_produk }}">
                                                    <img src="{{ asset('assets/images/produk/'.$data->gambar_produk[0]) }}" alt="" style="min-height: 200px;">
                                                </a>
                                                <!-- <span>hot</span> -->
                                                <div class="product-action-list-style">
                                                    <a class="animate-left" title="Wishlist" href="/wishlist/tambah/{{ $data->id_produk }}/1">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                    <a class="animate-right" title="Tambahkan ke Keranjang" href="/keranjang/tambah/{{ $data->id_produk }}/1">
                                                        <i class="pe-7s-cart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content-list">
                                                <div class="product-list-info">
                                                    <h4><a href="/produk/{{ $data->id_produk }}">{{ $data->nama_produk }}</a></h4>
                                                    <span>Rp. {{ number_format($data->harga,0,',',',') }}</span>
                                                    <p>{{ strlen($data->deskripsi_produk) > 50 ? substr($data->deskripsi_produk,0,50).' [...]' : $data->deskripsi_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto mx-auto"> 
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-extra')

<style type="text/css">
    .page-item {margin: 0 5px;}
    .page-link, .page-item.disabled .page-link {background-color: #f6f6f6; color: #3f3f3f; display: inline-block; font-size: 13px; font-weight: 500; height: 40px; line-height: 41px; width: 40px; padding: 0; border: 0; text-align: center;}
    .page-item.active .page-link, .page-link:hover { z-index: 2; background-color: #3f3f3f; color: #fff; border-color: #3f3f3f;}
    .page-item:first-child .page-link, .page-item:last-child .page-link {border-radius: 0;}
</style>

@endsection