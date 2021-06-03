@extends('template/admin/template')

@section('title', 'Edit Pengiriman')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Edit Pengiriman</h4>
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
					<a href="#">Pengiriman</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Edit Pengiriman</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/pengiriman/update">
						<div class="card-header">
							<div class="card-title">Edit Pengiriman</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $pengiriman->id_pengiriman }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('pengiriman') ? 'has-error' : '' }}">
										<label for="nama">Nama Pengiriman</label>
										<input type="text" name="pengiriman" class="form-control" id="nama" placeholder="Masukkan Nama Pengiriman" value="{{ $pengiriman->pengiriman }}">
                    					@if($errors->has('pengiriman'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('pengiriman')) }}</small>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="card-action">
							<button class="btn btn-success" type="submit">Simpan</button>
							<button class="btn btn-danger">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection