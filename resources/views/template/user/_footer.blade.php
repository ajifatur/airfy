		<footer class="footer-area">
            <div class="footer-top-area bg-img pt-105 pb-65" data-overlay="9">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Layanan Kami</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        <li><a href="/shop">Shop</a></li>
                                        <li><a href="/tentang-kami">Tentang Kami</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Bantuan</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                        @foreach($var_bantuan as $bantuan)
                                        <li><a href="/bantuan/{{ $bantuan->permalink_bantuan }}">{{ $bantuan->judul_bantuan }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Kontak</h3>
                                <div class="footer-newsletter">
                                    <div class="footer-contact">
                                        <p><span><i class="ti-location-pin"></i></span> {{ $var_kontak->alamat }} </p>
                                        <p><span><i class="pe-7s-call"></i></span> {{ $var_kontak->no_telepon }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom black-bg ptb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12 copyright">
                            <div class="row">
                                <span class="col-12 col-md-auto mr-md-auto text-center">
                                    Copyright ©
                                    <a href="#" target="_blank">Aji Fatur</a> 2019 - {{ date('Y') }} . All Rights Reserved.
                                </span>
                                <span class="col-12 col-md-auto ml-md-auto text-center mt-2 mt-md-0">
                                    Template by
                                    <a href="#" target="_blank">Ezone</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>