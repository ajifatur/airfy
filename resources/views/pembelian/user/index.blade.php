@extends('template/user/template')

@section('title', 'Pembelian')

@section('content')

<!-- breadcrumb -->
<div class="w-100" style="padding: 10px 0; background-color: rgba(0,0,0,.3);">
    <div class="breadcrumb-content text-center">
        <ul>
            <li><a href="/">home</a></li>
            <li>pembelian</li>
        </ul>
    </div>
</div>
<!-- /breadcrumb -->
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
                <h1 class="cart-heading mb-2">Pembelian</h1>
                <p class="pembayaran">Segera lakukan pembayaran maksimal 24 jam setelah melakukan pembelian.<br>
                Pembayaran dilakukan ke <strong>{{ $rekening->bank }}</strong> atas nama <strong>{{ $rekening->nama_rekening }}</strong> dengan nomor rekening <strong>{{ $rekening->nomor_rekening }}</strong>.</p>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Pembelian</th>
                                    <th>Pembelian</th>
                                    <th>Tanggal</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($pembelian)>0)
                                    @foreach($pembelian as $key=>$data)
                                    <tr>
                                        <td class="purchase-id">#{{ $data->id_pembelian }}</td>
                                        <td class="product-name" style="font-size: 15px; color: #555;">
                                            @foreach($data->keranjang as $items)
                                                {{ $items['n'] }} <strong>x {{ $items['q'] }}</strong><br>
                                            @endforeach
                                        </td>
                                        <td class="product-subtotal">{{ date('d-m-Y', strtotime($data->waktu_input)) }}</td>
                                        <td class="product-subtotal">Rp. {{ number_format($data->total,0,',',',') }}</td>
                                        @if($data->sudah_dibayar == 1 && $data->sudah_terverifikasi == 1 && $data->sudah_diterima == 1)
                                        <td class="product-remove"><i class="pe-7s-check text-success" title="Pembelian Clear"></i></td>
                                        @elseif($data->sudah_dibayar == 1 && $data->sudah_terverifikasi == 1 && $data->resi_pengiriman != '' && $data->sudah_diterima == 0)
                                        <td class="product-remove">
                                            <a href="#" class="cek-resi" data-id="{{ $data->id_pembelian }}" data-metode="{{ strtoupper($data->metode_pengiriman['jenis']) }} {{ $data->metode_pengiriman['layanan'] }}" data-resi="{{ $data->resi_pengiriman }}"><i class="pe-7s-gift" title="Pesanan sedang dikirim. Klik untuk mengetahui nomor resi."></i></a>
                                        </td>
                                        @elseif($data->sudah_dibayar == 1 && $data->sudah_terverifikasi == 1 && $data->resi_pengiriman == '' && $data->sudah_diterima == 0)
                                        <td class="product-remove"><i class="pe-7s-clock text-info" title="Pembelian sudah diverifikasi, tunggu sampai pesanan Anda dikirimkan."></i></td>
                                        @elseif($data->sudah_dibayar == 1 && $data->sudah_terverifikasi == 0)
                                        <td class="product-remove">
                                            <a href="/pembelian/confirm/edit/{{ $data->id_pembelian }}" title="Edit konfirmasi Pembayaran"><i class="pe-7s-note2"></i></a>
                                            <i class="pe-7s-timer text-info" title="Sudah melakukan konfirmasi pembayaran. Sedang menunggu verifikasi dari admin"></i>
                                        </td>
                                        @elseif($data->sudah_dibayar == 0)
                                            @if(time() - strtotime($data->waktu_input) <= 86400)
                                            <td class="product-remove"><a href="/pembelian/confirm/{{ $data->id_pembelian }}" title="Konfirmasi pembayaran"><i class="pe-7s-next-2"></i></a></td>
                                            @else
                                            <td class="product-remove"><i class="pe-7s-less text-danger expired" style="cursor:pointer;"></i></td>
                                            @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading mb-2">Status Pembelian</h1>
                <p>Berikut adalah keterangan gambar pada status pembelian:</p>
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="status-no">#1</td>
                                <td class="status-icon"><i class="pe-7s-next-2"></i></td>
                                <td>Baru saja melakukan pembelian, dan belum melakukan konfirmasi pembayaran.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#2</td>
                                <td class="status-icon"><i class="pe-7s-less"></i></td>
                                <td>Sudah tidak bisa melakukan pembelian dan pembayaran karena tidak melakukan pembayaran dalam waktu 24 jam setelah pembelian.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#3</td>
                                <td class="status-icon"><i class="pe-7s-note2"></i></td>
                                <td>Edit konfirmasi pembayaran.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#4</td>
                                <td class="status-icon"><i class="pe-7s-timer"></i></td>
                                <td>Sudah melakukan konfirmasi pembayaran. Sedang menunggu verifikasi dari admin.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#5</td>
                                <td class="status-icon"><i class="pe-7s-clock"></i></td>
                                <td>Pembelian sudah diverifikasi, tunggu sampai pesanan Anda dikirimkan.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#6</td>
                                <td class="status-icon"><i class="pe-7s-gift"></i></td>
                                <td>Pesanan sedang dikirim. Klik untuk mengetahui nomor resi.</td>
                            </tr>
                            <tr>
                                <td class="status-no">#7</td>
                                <td class="status-icon"><i class="pe-7s-check"></i></td>
                                <td>Pembelian clear atau tuntas.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->

@endsection

@section('js-extra')

<script type="text/javascript">
    // Mengecek metode dan resi pengiriman...
    $(document).on("click", ".cek-resi", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var metode = $(this).data("metode");
        var resi = $(this).data("resi");
        alert("Pengiriman: " + metode + "\n" + "\n" + "No. Resi: " + resi);
    });

    // Pembelian yang expired...
    $(document).on("click", ".expired", function(e){
        e.preventDefault();
        alert("Pembelian sudah EXPIRED karena Anda tidak melakukan pembayaran dalam waktu 24 jam setelah pembelian.");
    });
</script>

@endsection

@section('css-extra')

<style type="text/css">
    p.pembayaran strong {text-transform: uppercase;}
    .table-content table td {border-bottom: 1px solid #e4e4e4; padding: 10px;}
    .purchase-id, .status-no {color: #555; font-size: 15px!important; width: 100px;}
    .status-icon {width: 150px;}
    .status-icon i {color: #919191; display: inline-block; font-size: 35px; height: 40px; line-height: 40px; text-align: center; width: 40px;}
</style>

@endsection