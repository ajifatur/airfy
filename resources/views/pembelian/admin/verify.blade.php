@extends('template/admin/template')

@section('title', 'Verifikasi Pembayaran')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Verifikasi Pembayaran</h4>
			<ul class="breadcrumbs">
				<li class="nav-home">
					<a href="#">
						<i class="flaticon-home"></i>
					</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Verifikasi Pembayaran</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Verifikasi Pembayaran</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Pembelian</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Pembeli</label>
											<p>{{ $pembelian->nama_user }}</p>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Tanggal Pembelian</label>
											<p>{{ date('d-m-Y', strtotime($pembelian->waktu_input)) }}</p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Pembelian</label>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Produk</th>
													<th>Harga</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
			                                    @foreach($pembelian->keranjang as $items)
												<tr>
													<td>{{ $items['n'] }} <strong>x {{ $items['q'] }}</strong></td>
			                                        <td>Rp. {{ number_format($items['h'],0,',',',') }} <strong>x {{ $items['q'] }}</strong></td>
			                                        <td>Rp. {{ number_format($items['t'],0,',',',') }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Subtotal</label>
											<p>Rp. {{ number_format($pembelian->subtotal,0,',',',') }}</p>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Ongkos Kirim</label>
											<p>Rp. {{ number_format($pembelian->ongkir,0,',',',') }}</p>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Total</label>
											<p>Rp. {{ number_format($pembelian->total,0,',',',') }}</p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Alamat Pengiriman</label>
									<p><strong>Alamat:</strong> {{ $pembelian->alamat_pengiriman }}</p>
									<p><strong>Kota:</strong> {{ $pembelian->kota_pengiriman }}</p>
									<p><strong>Kode Pos:</strong> {{ $pembelian->kode_pos_pengiriman }}</p>
									<p><strong>No. Telepon:</strong> {{ $pembelian->no_telp_pengiriman }}</p>
								</div>
								<div class="form-group">
									<label>Metode Pengiriman</label>
									<p>{{ strtoupper($pembelian->metode_pengiriman['jenis']) }} {{ $pembelian->metode_pengiriman['layanan'] }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Pembayaran</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Nama Rekening</label>
									<p>{{ $pembayaran->nama_rekening }}</p>
								</div>
								<div class="form-group">
									<label>Tanggal Pembayaran</label>
									<p>{{ date('d-m-Y', strtotime($pembayaran->tanggal_pembayaran)) }}</p>
								</div>
								<div class="form-group">
									<label>Jumlah Pembayaran</label>
									<p>Rp. {{ number_format($pembayaran->jumlah_pembayaran,0,',',',') }}</p>
								</div>
								<div class="form-group">
									<label>Bukti Pembayaran</label>
									<img class="img-fluid img-thumbnail" id="bukti" src="{{ asset('assets/images/bukti-pembayaran/'.$pembayaran->bukti_pembayaran) }}">
								</div>
							</div>
						</div>
					</div>
					<div class="card-action">
						<form method="post" action="/admin/pembelian/verification">
							{{ csrf_field() }}
							<input type="hidden" name="id_pembelian" value="{{ $pembelian->id_pembelian }}">
							<input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id_pembayaran }}">
							<button class="btn btn-block btn-success" type="submit">Verifikasi</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-extra')

<script type="text/javascript">
	$(document).on("click", "#bukti", function(e){
		e.preventDefault();
		var src = $(this).attr("src");
		window.open(src, "_blank");
	})
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.table th {border-top-width: 2px!important;}
	.table td, .table th {height: auto!important; padding: 10px!important;}
	.form-group p {margin-bottom: 0;}
	#bukti {cursor: pointer;}
</style>

@endsection