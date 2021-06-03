@extends('template/admin/template')

@section('title', 'Kirim Pesanan')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Kirim Pesanan</h4>
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
					<a href="#">Data Pembelian</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Kirim Pesanan</a>
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
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<form method="post" action="/admin/pembelian/send-order">
						{{ csrf_field() }}
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Pengiriman</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('metode_pengiriman') ? 'has-error' : '' }}">
										<label>Metode Pengiriman</label>
										<input type="text" name="metode" class="form-control" value="{{ strtoupper($pembelian->metode_pengiriman['jenis']) }} {{ $pembelian->metode_pengiriman['layanan'] }}" readonly>
									</div>
									<div class="form-group {{ $errors->has('resi_pengiriman') ? 'has-error' : '' }}">
										<label>Nomor Resi</label>
										<input type="text" class="form-control" name="resi_pengiriman" placeholder="Masukkan Nomor Resi">
                    					@if($errors->has('resi_pengiriman'))
											<small id="error-resi" class="form-text text-danger">{{ ucfirst($errors->first('resi_pengiriman')) }}</small>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="card-action">
							<input type="hidden" name="id_pembelian" value="{{ $pembelian->id_pembelian }}">
							<button class="btn btn-block btn-success" type="submit">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-extra')

<script type="text/javascript">
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.table th {border-top-width: 2px!important;}
	.table td, .table th {height: auto!important; padding: 10px!important;}
	.form-group p {margin-bottom: 0;}
</style>

@endsection