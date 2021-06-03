@extends('template/user/template')

@section('title', 'Konfirmasi Pembayaran')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="/pembelian">pembelian</a></li>
            <li>edit konfirmasi pembayaran</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
<!--         <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion"> 
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
                </div>
            </div>
        </div> -->
        <form id="form" method="post" action="/pembelian/confirm/update" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 mx-auto">
                    <div class="checkbox-form">                     
                        <h3>Konfirmasi Pembayaran</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Nama Rekening Pengirim <span class="required">*</span></label>
                                    <input name="nama_rekening" type="text" class="{{ $errors->has('nama_rekening') ? 'border border-danger' : '' }}" value="{{ $pembayaran->nama_rekening }}" />
                                    @if($errors->has('nama_rekening'))
                                        <small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama_rekening')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Jumlah Pembayaran (Rp.) <span class="required">*</span></label>
                                    <input name="jumlah_pembayaran" type="text" class="{{ $errors->has('jumlah_pembayaran') ? 'border border-danger' : '' }}" value="{{ number_format($pembayaran->jumlah_pembayaran,0,',',',') }}" />
                                    @if($errors->has('jumlah_pembayaran'))
                                        <small id="error-jumlah" class="form-text text-danger">{{ ucfirst($errors->first('jumlah_pembayaran')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Tanggal Pembayaran <span class="required">*</span></label>
                                    <input name="tanggal_pembayaran" type="date" class="{{ $errors->has('tanggal_pembayaran') ? 'border border-danger' : '' }}" value="{{ $pembayaran->tanggal_pembayaran }}" />
                                    @if($errors->has('tanggal_pembayaran'))
                                        <small id="error-tanggal" class="form-text text-danger">{{ ucfirst($errors->first('tanggal_pembayaran')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Bukti Pembayaran <span class="required">*</span></label>
                                    <button type="button" class="btn" id="btn-upload-file" style="cursor: pointer;">Upload File</button>
                                    <input type="file" id="file" accept="image/*" style="display: none;"/>
                                    <input type="hidden" name="bukti_pembayaran" id="bukti">
                                    <br>
                                    <img class="img-thumbnail mt-3 bukti-gambar" src="{{ asset('assets/images/bukti-pembayaran/'.$pembayaran->bukti_pembayaran) }}" width="300">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="order-button-payment">
                                    <input type="hidden" name="id" value="{{ $pembayaran->id_pembayaran }}">
                                    <input type="hidden" name="id_pembelian" value="{{ $pembayaran->id_pembelian }}">
                                    <input type="submit" value="Konfirmasi Pembayaran">
                                </div>
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

<script type="text/javascript">
    // Mengubah nilai jumlah pembayaran
    $(document).on("change", "input[name='jumlah_pembayaran']", function(){
        var jumlah_pembayaran = $(this).val();

        // Generate subtotal produk...
        $.ajax({
          type: "get",
          url: "/pembelian/generate-price/"+jumlah_pembayaran,
          success: function(response){
            $("input[name='jumlah_pembayaran']").val(response);
          }
        });
    });

    // Mengupload gambar...
    $(document).on("click", "#btn-upload-file", function(){
        var file = $("#file");
        file.trigger("click");
    });
    function readURL(input) {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#bukti").val(e.target.result);
                $(".bukti-gambar").attr("src", e.target.result).removeClass("d-none");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on("change", "#file", function() {
        readURL(this);
        $(this).val(null);
    });

    // Submit form
    // $(document).on("submit", "#form", function(e){
    //     e.preventDefault();
    //     var bukti = $("#bukti").val();
    //     if(bukti == "" || bukti == null){
    //         alert("Anda harus mengupload bukti pembayaran");
    //     }
    //     else{
    //         $("#form")[0].submit();
    //     }
    // });
</script>

@endsection