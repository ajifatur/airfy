@extends('template/user/template')

@section('title', 'Checkout')

@section('head-extra')

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>checkout</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <form method="post" action="/pembelian/store">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="checkbox-form">                     
                        <h3>Alamat dan Metode Pengiriman</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>No. Telepon  <span class="required">*</span></label>
                                    <input name="no_telp_pengiriman" type="text" required/>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Alamat Lengkap <span class="required">*</span></label>
                                    <input name="alamat_pengiriman" type="text" required/>
                                </div>
                            </div>
                           <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Kabupaten / Kota <span class="required">*</span></label>
                                    <select class="form-control select2" name="kota_pengiriman" id="kota" required>
                                        <option value="" disabled selected>--Pilih--</option>
                                        @foreach($decode['rajaongkir']['results'] as $key=>$data)
                                        <option value="{{ $decode['rajaongkir']['results'][$key]['city_name_rev'] }}" data-postalcode="{{ $decode['rajaongkir']['results'][$key]['postal_code'] }}">{{ $decode['rajaongkir']['results'][$key]['city_name_rev'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Kode Pos <span class="required">*</span></label>
                                    <input name="kode_pos_pengiriman" id="kode-pos" type="text" readonly required/>
                                </div>
                            </div>
                            <input name="berat" type="hidden" value="{{ $berat }}"/>  
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Metode Pengiriman  <span class="required">*</span></label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <input name="metode_pengiriman" type="radio" value="jne">JNE
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input name="metode_pengiriman" type="radio" value="pos">POS Indonesia
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input name="metode_pengiriman" type="radio" value="tiki">TIKI
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <p class="service-label d-none m-0">Pilih salah satu layanan: <span class="required text-danger">*</span></p>
                                <table class="services d-none" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Layanan</th>
                                            <th width="100">Ongkir</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>                                              
                    </div>
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
                                    @foreach($item as $key=>$data)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $data['n'] }} <strong class="product-quantity"> × {{ $data['q'] }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">Rp. {{ number_format($data['t'],0,',',',') }}</span>
                                        </td>
                                        <input type="hidden" name="p[]" value="{{ $data['p'] }}">
                                        <input type="hidden" name="q[]" value="{{ $data['q'] }}">
                                        <input type="hidden" name="h[]" value="{{ $data['h'] }}">
                                        <input type="hidden" name="t[]" value="{{ $data['t'] }}">
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td><span class="amount">Rp. {{ number_format($subtotal,0,',',',') }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Ongkos Kirim</th>
                                        <td><span class="amount" id="text-ongkir">-</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="amount" id="text-total">Rp. {{ number_format($total,0,',',',') }}</span></strong></td>
                                    </tr>                               
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <h5 class="panel-title">Metode Pembayaran</h5>
                            <p style="color: #666;">Pembayaran dilakukan langsung ke dalam rekening kami. Pembelian Anda tidak akan dikirimkan sampai nominal dikirimkan ke dalam rekening kami dan Anda melakukan konfirmasi pembayaran.</p>
                            <p style="color: #666;">Pembayaran dilakukan ke <strong>{{ $rekening->bank }}</strong> atas nama <strong>{{ $rekening->nama_rekening }}</strong> dengan nomor rekening <strong>{{ $rekening->nomor_rekening }}</strong>.</p>
                            <div class="order-button-payment">
                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                <input type="hidden" name="ongkir" id="ongkir">
                                <input type="hidden" name="total" id="total" value="{{ $total }}">
                                <input type="hidden" name="id_keranjang" value="{{ $keranjang->id_keranjang }}">
                                <input type="submit" value="Pembayaran" />
                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->  

@endsection

@section('js-extra')

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript">
    // Select2...
    $(document).ready(function(){
        $(".select2").select2();
    });

    // Mendapatkan kode pos...
    $(document).on("change", "#kota", function(){
        var city_id = $(this).val();
        var postal_code = $("#kota option[value=" + city_id + "]").data("postalcode");
        $("#kode-pos").val(postal_code);
    });
    
    // Cek Ongkir...
    $(document).on("change", "#kota, input[name=metode_pengiriman]", function(){
        var tujuan = $("#kota").val();
        var berat = $("input[name=berat]").val();
        var kurir = $("input[name=metode_pengiriman]:checked").val();
        if(tujuan != null && kurir != undefined){
            $.ajax({
                type: "post",
                url: "/cek-ongkir",
                data: {tujuan: tujuan, berat: berat, kurir: kurir, _token: "{{ csrf_token() }}"},
                success: function(response){
                    var html = "";
                    if(response.rajaongkir.results[0].costs.length > 0){
                        $.each(response.rajaongkir.results[0].costs, function(key,data){
                            html += '<tr>';
                            html += '<td><input name="service" type="radio" value="' + data.service + '" data-id="' + key + '"> ' + data.service + '</td>';
                            html += '<td align="right">' + formatRupiah(data.cost[0].value, 'Rp. ') + ' <input type="hidden" class="nominal-ongkir" data-id="' + key + '" value="' + data.cost[0].value + '"></td>';
                            html += '</tr>';
                        });
                    }
                    else{
                        html += '<tr>';
                        html += '<td colspan="2" align="center"><em class="text-danger">Layanan tidak tersedia.</em></td>';
                        html += '</tr>';
                    }
                    $(".service-label").removeClass("d-none");
                    $(".services").removeClass("d-none");
                    $(".services tbody").html(html);
                }
            });
        }
    });

    // Get ongkir
    $(document).on("change", "input[name=service]", function(){
        var service = $(this).val();
        var id = $(this).data("id");
        var total = $("#total").val();
        var ongkir = $(".nominal-ongkir[data-id="+id+"]").val();
        total = parseInt(total) + parseInt(ongkir);
        $("#ongkir").val(ongkir);
        $("#total").val(total);
        $("#text-ongkir").text(formatRupiah(ongkir, "Rp. "));
        $("#text-total").text(formatRupiah(total, "Rp. "));
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

@endsection

@section('css-extra')

<style type="text/css">
    .select2-container--default .select2-selection--single {border: 1px solid #e5e5e5; border-radius: 0; height: 42px;}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 42px;}
    .select2-container--default .select2-selection--single .select2-selection__arrow {height: 42px;}
    .services tr td, .services tr th {padding: 5px; border: 1px solid #bebebe;}
    .services tr th {text-align: center;}
    input[type="radio"] {height: auto; width: initial; margin-right: 10px;}
    .payment-method strong {text-transform: uppercase;}
</style>

@endsection