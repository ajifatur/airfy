@extends('template/admin/template')

@section('title', 'Konfirmasi Pesanan Telah Diterima')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Konfirmasi Pesanan Telah Diterima</h4>
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
					<a href="#">Konfirmasi Pesanan Telah Diterima</a>
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
											<label>Total</label>
											<p>Rp. {{ number_format($pembelian->total,0,',',',') }}</p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Alamat Pengiriman</label>
									<p><strong>Alamat:</strong> {{ $pembelian->alamat_pengiriman }}</p>
									<p><strong>Kota:</strong> {{ $pembelian->kota_pengiriman }}</p>
									<p><strong>Negara:</strong> {{ $pembelian->negara_pengiriman }}</p>
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
					<form method="post" action="/admin/pembelian/received-order">
						{{ csrf_field() }}
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Penerimaan</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('tanggal_diterima') ? 'has-error' : '' }}">
										<label>Tanggal Diterima</label>
										<input type="date" class="form-control" name="tanggal_diterima">
                    					@if($errors->has('tanggal_diterima'))
											<small id="error-tanggal-diterima" class="form-text text-danger">{{ ucfirst($errors->first('tanggal_diterima')) }}</small>
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