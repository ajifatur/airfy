@extends('template/user/template')

@section('title', 'Wishlist')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>wishlist</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if(count($item)>0)
                <h1 class="cart-heading">Wishlist</h1>
                <form action="/checkout" method="post">
                    {{ csrf_field() }}
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tambah</th>
                                    <th>Hapus</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item as $key=>$data)
                                <tr>
                                    <td class="product-remove"><a class="add-to-cart" data-id="{{ $data['p'] }}" href="#" title="Tambahkan ke Keranjang"><i class="pe-7s-plus"></i></a></td>
                                    <td class="product-remove"><a class="delete" data-id="{{ $data['p'] }}" href="#" title="Hapus dari Wishlist"><i class="pe-7s-close-circle"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="/produk/{{ $data['p'] }}"><img src="{{ asset('assets/images/produk/'.$data['g']) }}" alt="" width="100px"></a>
                                    </td>
                                    <td class="product-name"><a href="/produk/{{ $data['p'] }}">{{ $data['n'] }}</a></td>
                                    <td class="product-price-cart"><span class="amount">Rp. {{ number_format($data['h'],0,',',',') }}</span></td>
                                    <td class="product-quantity">
                                        <input class="qty" data-id="{{ $key }}" data-idp="{{ $data['p'] }}" data-qmax="{{ $data['qmax'] }}" value="{{ $data['q'] }}" type="number">
                                    </td>
                                    <td class="product-subtotal" data-id="{{ $key }}">
                                        Rp. {{ number_format($data['t'],0,',',',') }}
                                    </td>
                                    <input type="hidden" class="input-price" data-id="{{ $key }}" value="{{ $data['h'] }}">
                                    <input type="hidden" class="input-product-subtotal" data-id="{{ $key }}" value="{{ $data['t'] }}">
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Total Wishlist</h2>
                                <ul>
                                    <li>Subtotal<span id="cart-subtotal">Rp. {{ number_format($subtotal,0,',',',') }}</span></li>
                                    <li>Total<span id="cart-total">Rp. {{ number_format($total,0,',',',') }}</span></li>
                                    <input id="subtotal" type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <input id="total" type="hidden" name="total" value="{{ $total }}">
                                    <input type="hidden" name="id" value="{{ $wishlist->id_wishlist }}">
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="row">
                    <div class="col-12 col-md-8 mx-md-auto text-center">
                        <!-- <img src="{{ asset('assets/images/others/empty-cart.png') }}" width="200"> -->
                        <i class="ti-heart" style="font-size: 100px"></i>
                        <p class="h5 my-3">Wishlist Anda kosong.</p>
                        <a href="/shop" class="btn-begin-shopping">Mulai Mencari</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->

@endsection

@section('js-extra')

<script type="text/javascript">
    // Menambahkan data di wishlist ke keranjang...
    $(document).on("click", ".add-to-cart", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: "/wishlist/add-to-cart",
            data: {id: id, _token: "{{ csrf_token() }}"},
            success: function(response){
                if(response == "Berhasil menambahkan data ke keranjang."){
                    alert(response);
                    window.location.href = '/keranjang';
                }
                else{
                    alert(response);
                }
            }
        });
    });

    // Menghapus data...
    $(document).on("click", ".delete", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus produk ini dari wishlist?");
        if(ask){
            $.ajax({
                type: "get",
                url: "/wishlist/delete/"+id,
                data: {id: id},
                success: function(response){
                    if(response == "Berhasil menghapus data."){
                        alert(response);
                        window.location.href = '/wishlist';
                    }
                    else{
                        alert(response);
                    }
                }
            });
        }
    });

    // Mengatur kuantitas, subtotal, dan total...
    $(document).on("change", ".qty", function(){
        var id = $(this).data("id");									
        var idp = $(this).data("idp");									// id produk
        var qmax = $(this).data("qmax");								// kuantitas max (stok)
        var q = $(this).val();											// kuantitas
        var p = $(".input-price[data-id='"+id+"']").val();				// harga produk
        var s = $(".input-product-subtotal[data-id='"+id+"']").val();	// subtotal produk
        var st = $("#subtotal").val();									// subtotal wishlist
        var t = $("#total").val();										// total
        var product_quantity = q >= 1 ? q > qmax ? qmax : q : 1;
        var product_subtotal = Number(product_quantity) * Number(p);
        $(this).val(product_quantity);
        $(".input-product-subtotal[data-id='"+id+"']").val(product_subtotal);

        // Update database wishlist...
        $.ajax({
          type: "get",
          url: "/wishlist/edit/"+idp+"/"+q,
          success: function(){
            //
          }
        });

        // Generate subtotal produk...
        $.ajax({
          type: "get",
          url: "/wishlist/generate-price/"+product_subtotal,
          success: function(response){
            $(".product-subtotal[data-id='"+id+"']").text("Rp. "+response);
          }
        });

        total_price();
    });

    // Fungsi subtotal dan total
    function total_price(){
        var selector = $(".input-product-subtotal");
        var subtotal = 0;
        var total = 0;
        selector.each(function(){
            var id = $(this).data("id");
            var total_price = $('.input-product-subtotal[data-id="'+id+'"]').val();
            subtotal = Number(subtotal) + Number(total_price);
        });
        total = subtotal;
        $("#subtotal").val(subtotal);
        $("#total").val(total);

        // Generate subtotal wishlist...
        $.ajax({
          type: "get",
          url: "/wishlist/generate-price/"+subtotal,
          success: function(response){
            $("#cart-subtotal").text("Rp. "+response);
          }
        });

        // Generate total wishlist...
        $.ajax({
          type: "get",
          url: "/wishlist/generate-price/"+total,
          success: function(response){
            $("#cart-total").text("Rp. "+response);
          }
        });
    }
</script>

@endsection

@section('css-extra')

<style type="text/css">
    .table-content table td.product-remove {width: 100px;}
    .btn-checkout {background-color: #333; border: 0 none; border-radius: 2px; color: #fff; display: inline-block; font-size: 13px; font-weight: 700; height: 42px; letter-spacing: 1px; line-height: 42px; padding: 0 25px; margin-top: 16px; text-transform: uppercase; transition: all 0.3s ease-in-out 0s; width: inherit; cursor: pointer;}
    .btn-checkout:hover {background-color: #050035; border: medium none; color: #fff;}
    .btn-begin-shopping {border: 1px solid #383838; border-radius: 50px; color: #383838; display: inline-block; font-weight: bold; line-height: 1; padding: 14px 30px 12px; text-transform: uppercase;}
    .btn-begin-shopping:hover, .btn-begin-shopping:active {background-color: #383838; color: #fff;}
</style>

@endsection