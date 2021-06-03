@extends('template/user/template')

@section('title', 'Tentang Kami')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>Tentang Kami</li>
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
                            <li>{{ $tentang_kami->author }}</li>
                            <li>{{ date('d M Y', strtotime($tentang_kami->waktu_input)) }}</li>
                        </ul>
                    </div>
                    <h3>Tentang Kami</h3>
                    <p>{!! html_entity_decode($tentang_kami->konten_tentang_kami) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->
@endsection