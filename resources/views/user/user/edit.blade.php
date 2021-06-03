@extends('template/user/template')

@section('title', 'Edit Profil')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="/profil">profil</a></li>
            <li>edit profil</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <form id="form" method="post" action="/profil/update" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 mx-auto">
                    <div class="checkbox-form">                     
                        <h3>Edit Profil</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Nama <span class="required">*</span></label>
                                    <input name="nama" type="text" class="{{ $errors->has('nama') ? 'border border-danger' : '' }}" value="{{ Auth::user()->nama }}" />
                                    @if($errors->has('nama'))
                                        <small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Username<span class="required">*</span></label>
                                    <input name="username" type="text" class="{{ $errors->has('username') ? 'border border-danger' : '' }}" value="{{ Auth::user()->username }}" />
                                    @if($errors->has('username'))
                                        <small id="error-username" class="form-text text-danger">{{ ucfirst($errors->first('username')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Email<span class="required">*</span></label>
                                    <input name="email" type="email" class="{{ $errors->has('email') ? 'border border-danger' : '' }}" value="{{ Auth::user()->email }}" />
                                    @if($errors->has('email'))
                                        <small id="error-email" class="form-text text-danger">{{ ucfirst($errors->first('email')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>No. Telepon</label>
                                    <input name="no_telepon" type="text" class="{{ $errors->has('no_telepon') ? 'border border-danger' : '' }}" value="{{ Auth::user()->no_telepon }}" />
                                    @if($errors->has('no_telepon'))
                                        <small id="error-no-telepon" class="form-text text-danger">{{ ucfirst($errors->first('no_telepon')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Password</label>
                                    <input name="password" type="password" class="{{ $errors->has('password') ? 'border border-danger' : '' }}"/>
                                    <small>Kosongi saja jika tidak ingin mengganti password.</small>
                                    @if($errors->has('password'))
                                        <small id="error-password" class="form-text text-danger">{{ ucfirst($errors->first('password')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Ulangi Password</label>
                                    <input name="password_confirmation" type="password" class="{{ $errors->has('password') ? 'border border-danger' : '' }}"/>
                                    <small>Kosongi saja jika tidak ingin mengganti password.</small>
                                    @if($errors->has('password'))
                                        <small id="error-password" class="form-text text-danger">{{ ucfirst($errors->first('password')) }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Foto</label>
                                    <button type="button" class="btn" id="btn-upload-file" style="cursor: pointer;">Upload File</button>
                                    <input type="file" id="file" accept="image/*" style="display: none;"/>
                                    <input type="hidden" name="foto" id="foto">
                                    <br>
                                    <img class="img-thumbnail mt-3 foto-img" src="{{ asset('assets/images/user/'.Auth::user()->foto) }}" width="300">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="order-button-payment">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id_user }}">
                                    <input type="submit" value="Update Profil">
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
    // Mengupload gambar...
    $(document).on("click", "#btn-upload-file", function(){
        var file = $("#file");
        file.trigger("click");
    });
    function readURL(input) {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#foto").val(e.target.result);
                $(".foto-img").attr("src", e.target.result).removeClass("d-none");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on("change", "#file", function() {
        readURL(this);
        $(this).val(null);
    });
</script>

@endsection