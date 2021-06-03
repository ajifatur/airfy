@extends('template/admin/template')

@section('title', 'Rekening')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Rekening</h4>
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
					<a href="#">Rekening</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/rekening/update" enctype="multipart/form-data">
						<div class="card-header">
							<div class="card-title">Rekening</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
										<label for="bank">Bank</label>
										<input type="text" name="bank" class="form-control" id="bank" placeholder="Masukkan Nama Bank" value="{{ $rekening->bank }}">
                    					@if($errors->has('nama_perusahaan'))
											<small id="error-bank" class="form-text text-danger">{{ ucfirst($errors->first('bank')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('nama_rekening') ? 'has-error' : '' }}">
										<label for="nama">Nama Pemilik Rekening</label>
										<input type="text" name="nama_rekening" class="form-control" id="nama_rekening" placeholder="Masukkan Nama Pemilik Rekening" value="{{ $rekening->nama_rekening }}">
                    					@if($errors->has('nama_rekening'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama_rekening')) }}</small>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('nomor_rekening') ? 'has-error' : '' }}">
										<label for="nomor">Nomor Rekening</label>
										<input type="text" name="nomor_rekening" class="form-control" id="nomor_rekening" placeholder="Masukkan Nomor Rekening" value="{{ $rekening->nomor_rekening }}">
                    					@if($errors->has('nomor_rekening'))
											<small id="error-nomor" class="form-text text-danger">{{ ucfirst($errors->first('nomor_rekening')) }}</small>
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