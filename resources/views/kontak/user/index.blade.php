@extends('template/user/template')

@section('title', 'Kontak')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>kontak</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- contact-area start -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-map-wrapper">
                    <div class="contact-map mb-40">
                        <!--<div id="hastech2"></div>-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15837.988477221925!2d110.38788328555692!3d-7.068214073636589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708968a9b5ccc3%3A0x5027a76e356e080!2sPatemon%2C%20Kec.%20Gn.%20Pati%2C%20Kota%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1583297918640!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-wrapper">
                    <div class="contact-title">
                        <h4>Alamat dan Kontak</h4>
                    </div>
                    <div class="contact-info">
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Alamat:</span> {{ $kontak->alamat }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-mail"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Email: </span> {{ $kontak->email }}</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-call"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>No. Telepon: </span> {{ $kontak->no_telepon }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area end -->

@endsection

@section('js-extra')

<!-- google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlZPf84AAVt8_FFN7rwQY5nPgB02SlTKs "></script>
<script>
    var myCenter=new google.maps.LatLng(30.249796, -97.754667);
    function initialize()
    {
        var mapProp = {
          center:myCenter,
          scrollwheel: false,
          zoom:15,
          mapTypeId:google.maps.MapTypeId.ROADMAP
          };
        var map=new google.maps.Map(document.getElementById("hastech2"),mapProp);
        var marker=new google.maps.Marker({
          position:myCenter,
            animation:google.maps.Animation.BOUNCE,
          icon:'',
            map: map,
          });
        var styles = [
          {
            stylers: [
              { hue: "#c5c5c5" },
              { saturation: -100 }
            ]
          },
        ];
        map.setOptions({styles: styles});
        marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endsection
