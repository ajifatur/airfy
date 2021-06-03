@extends('template/user/template')

@section('title', $bantuan->judul_bantuan.' - Bantuan')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="#">bantuan</a></li>
            <li>{{ $bantuan->judul_bantuan }}</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- shopping-cart-area start -->
<div class="blog-details pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-details-info">
                    <div class="blog-meta">
                        <ul>
                            <li>{{ $bantuan->author }}</li>
                            <li>{{ date('d M Y', strtotime($bantuan->waktu_input)) }}</li>
                        </ul>
                    </div>
                    <h3>{{ $bantuan->judul_bantuan}}</h3>
                    <p>{!! html_entity_decode($bantuan->konten_bantuan) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->
@endsection