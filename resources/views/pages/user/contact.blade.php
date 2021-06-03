@extends('template/user/template')

@section('title', 'Kontak')

@section('content')

<!-- breadcrumb -->
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('assets/images/breadcrumb/2.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: center; padding-top: 0; padding-bottom: 0;">
    <div class="w-100" style="padding: 120px 0; background-color: rgba(0,0,0,.3);">
        <div class="breadcrumb-content text-center">
            <h2> kontak</h2>
            <ul>
                <li><a href="/">home</a></li>
                <li>kontak</li>
            </ul>
        </div>
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
                        <div id="hastech2"></div>
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
                                <p><span>Alamat:</span>  1234 - Bandit Tringi lAliquam <br> Vitae. New York</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-mail"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Email: </span> Support@plazathemes.com</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-call"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>No. Telepon: </span>  (800) 0123 456 789</p>
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