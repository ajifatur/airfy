@extends('template/user/template')

@section('title', 'Profil')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>Profil</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- contact-area start -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-map-wrapper">
                    <div class="contact-map mb-40">
                        @if(Auth::user()->foto != '')
                        <img class="img-fluid w-100" src="{{ asset('assets/images/user/'.Auth::user()->foto) }}">
                        @else
                        <img class="img-fluid w-100" src="{{ asset('assets/images/user/'.Auth::user()->foto) }}" alt="Tidak ada foto profil">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info-wrapper">
                    <div class="contact-title">
                        <h4>Identitas</h4>
                    </div>
                    <div class="contact-info">
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="ti-id-badge"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Nama:</span> {{ Auth::user()->nama }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="ti-face-smile"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Username:</span> {{ Auth::user()->username }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Email: </span> {{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-call"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>No. Telepon: </span> {{ Auth::user()->no_telepon }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <a class="btn btn-sm btn-edit-profile" href="/profil/edit">Edit Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area end -->

@endsection

@section('css-extra')

<style type="text/css">
    .btn-edit-profile {background: #464646 none repeat scroll 0 0; color: #fff; text-transform: uppercase; transition: all 0.3s ease 0s; font-weight: 600;}
    .btn-edit-profile:hover {background: #050035; border: 1px solid #050035; color: #fff;}
</style>

@endsection