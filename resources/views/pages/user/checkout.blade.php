@extends('template/user/template')

@section('title', 'Checkout')

@section('content')

<!-- breadcrumb -->
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('assets/images/breadcrumb/2.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center; padding-top: 0; padding-bottom: 0;">
    <div class="w-100" style="padding: 120px 0; background-color: rgba(0,0,0,.3);">
        <div class="breadcrumb-content text-center">
            <h2> checkout</h2>
            <ul>
                <li><a href="/">home</a></li>
                <li>checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion"> 
                    <!-- ACCORDION START -->
                    <h3>Punya kupon? <span id="showcoupon">Klik disini untuk menggunakan kupon</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input type="text" placeholder="Kode kupon" />
                                    <input type="submit" value="Gunakan" />
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->                      
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <form action="#">
                    <div class="checkbox-form">                     
                        <h3>Alamat Pengiriman</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Alamat Lengkap <span class="required">*</span></label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Kabupaten / Kota <span class="required">*</span></label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Negara <span class="required">*</span></label>
                                    <input type="text" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Kode Pos <span class="required">*</span></label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>No. Telepon  <span class="required">*</span></label>
                                    <input type="text" />
                                </div>
                            </div>                             
                        </div>                                              
                    </div>
                </form>
            </div>  
            <div class="col-lg-6 col-md-12 col-12">
                <div class="your-order">
                    <h3>Pembayaran</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Produk</th>
                                    <th class="product-total">Total</th>
                                </tr>                           
                            </thead>
                            <tbody>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Vestibulum suscipit <strong class="product-quantity"> × 1</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">£165.00</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Vestibulum dictum magna <strong class="product-quantity"> × 1</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">£50.00</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="amount">£215.00</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td><strong><span class="amount">£215.00</span></strong>
                                    </td>
                                </tr>                               
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <h5 class="panel-title">Metode Pembayaran</h5>
                        <p style="color: #666;">Pembayaran dilakukan langsung ke dalam rekening kami. Pembelian Anda tidak akan dikirimkan sampai nominal dikirimkan ke dalam rekening kami dan Anda melakukan konfirmasi pembayaran.</p>
                        <div class="order-button-payment">
                            <input type="submit" value="Pembayaran" />
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->  

@endsection