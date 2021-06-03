@extends('template/user/template')

@section('title', 'Keranjang')

@section('content')

<!-- breadcrumb -->
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('assets/images/breadcrumb/2.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center; padding-top: 0; padding-bottom: 0;">
    <div class="w-100" style="padding: 120px 0; background-color: rgba(0,0,0,.3);">
        <div class="breadcrumb-content text-center">
            <h2> keranjang</h2>
            <ul>
                <li><a href="/">home</a></li>
                <li>keranjang</li>
            </ul>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Keranjang</h1>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/cart/1.jpg') }}" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">Wooden Furniture </a></td>
                                    <td class="product-price-cart"><span class="amount">$165.00</span></td>
                                    <td class="product-quantity">
                                        <input value="1" type="number">
                                    </td>
                                    <td class="product-subtotal">$165.00</td>
                                </tr>
                                <tr>
                                    <td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/cart/2.jpg') }}" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">Vestibulum dictum</a></td>
                                    <td class="product-price-cart"><span class="amount">$150.00</span></td>
                                    <td class="product-quantity">
                                        <input value="1" type="number">
                                    </td>
                                    <td class="product-subtotal">$150.00</td>
                                </tr>
                                <tr>
                                    <td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ asset('templates/ezone/assets/img/cart/3.jpg') }}" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">Vestibulum dictum</a></td>
                                    <td class="product-price-cart"><span class="amount">$150.00</span></td>
                                    <td class="product-quantity">
                                        <input value="1" type="number">
                                    </td>
                                    <td class="product-subtotal">$150.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
<!--                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Total Keranjang</h2>
                                <ul>
                                    <li>Subtotal<span>100.00</span></li>
                                    <li>Total<span>100.00</span></li>
                                </ul>
                                <a href="#">Lanjut ke checkout</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->

@endsection