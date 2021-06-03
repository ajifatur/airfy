@extends('template/admin/template')

@section('title', 'Tambah Kategori')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Tambah Kategori</h4>
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
					<a href="#">Kategori</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Tambah Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/kategori/store">
						<div class="card-header">
							<div class="card-title">Tambah Kategori</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('nama_kategori') ? 'has-error' : '' }}">
										<label for="nama">Nama Kategori</label>
										<input type="text" name="nama_kategori" class="form-control" id="nama" placeholder="Masukkan Nama Kategori" value="{{ old('nama_kategori') }}">
                    					@if($errors->has('nama_kategori'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama_kategori')) }}</small>
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