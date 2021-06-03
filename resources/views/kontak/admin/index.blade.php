@extends('template/admin/template')

@section('title', 'Kontak')

@section('head-extra')

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Kontak</h4>
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
					<a href="#">Kontak</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/kontak/update" enctype="multipart/form-data">
						<div class="card-header">
							<div class="card-title">Kontak</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('nama_perusahaan') ? 'has-error' : '' }}">
										<label for="nama">Nama Perusahaan</label>
										<input type="text" name="nama_perusahaan" class="form-control" id="nama" placeholder="Masukkan Nama Perusahaan" value="{{ $kontak->nama_perusahaan }}">
                    					@if($errors->has('nama_perusahaan'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama_perusahaan')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
										<label for="alamat">Alamat Perusahaan</label>
										<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Perusahaan" value="{{ $kontak->alamat }}">
                    					@if($errors->has('alamat'))
											<small id="error-alamat" class="form-text text-danger">{{ ucfirst($errors->first('alamat')) }}</small>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Logo</label>
										<div class="row">
											<div class="col">
												<button class="btn btn-sm btn-primary btn-upload-img mr-2" data-toggle="tooltip" title="" data-original-title="Upload Logo">
													<i class="fa fa-upload"></i>
												</button>
											</div>
										</div>
										<input type="file" class="form-control-file d-none" id="file" accept="image/*">
										<div class="row mt-3 imagecheck-field">
											@if($kontak->logo_perusahaan != '')
												<div class="col-md-6 col-12 imagecheck-div">
													<label class="imagecheck mb-4">
														<input type="hidden" name="logo_src" value="">
														<figure class="imagecheck-figure">
															<img src="{{ asset('assets/images/logo/'.$kontak->logo_perusahaan) }}" alt="title" class="imagecheck-image">
														</figure>
													</label>
												</div>
											@else
												<input type="hidden" name="logo_src" value="">
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email">Email Perusahaan</label>
										<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email Perusahaan" value="{{ $kontak->email }}">
                    					@if($errors->has('email'))
											<small id="error-email" class="form-text text-danger">{{ ucfirst($errors->first('email')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('no_telepon') ? 'has-error' : '' }}">
										<label for="no-telepon">No. Telepon</label>
										<input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="Masukkan Nomor Telepon" value="{{ $kontak->no_telepon }}">
                    					@if($errors->has('no_telepon'))
											<small id="error-no-telepon" class="form-text text-danger">{{ ucfirst($errors->first('no_telepon')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('kota_pengiriman') ? 'has-error' : '' }}">
										<label for="kota">Kab/Kota Awal Pengiriman Barang</label>
										<select class="form-control select2" name="kota_pengiriman">
											@foreach($decode['rajaongkir']['results'] as $key=>$data)
											<option value="{{ $decode['rajaongkir']['results'][$key]['city_id'] }}" {{ $decode['rajaongkir']['results'][$key]['city_id'] == $kontak->kota_pengiriman ? 'selected' : '' }}>{{ $decode['rajaongkir']['results'][$key]['city_name_rev'] }}</option>
											@endforeach
										</select>
                    					@if($errors->has('kota_pengiriman'))
											<small id="error-kota-pengiriman" class="form-text text-danger">{{ ucfirst($errors->first('kota_pengiriman')) }}</small>
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

@section('js-extra')

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script type="text/javascript">
	// Select2
	$(document).ready(function(){
		$(".select2").select2();
	});

    // Mengupload gambar...
	$(document).on("click", ".btn-upload-img", function(e){
    	e.preventDefault();
		$("#file").trigger("click");
	});
	function readURL(input) {
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function(e){
    			var element = $(".imagecheck-input");
				var html = '';
				html += '<div class="col-md-6 col-12 imagecheck-div">';
				html += '<label class="imagecheck mb-4">';
				html += '<input type="hidden" name="logo_src" value="'+e.target.result+'">';
				html += '<figure class="imagecheck-figure">';
				html += '<img src="'+e.target.result+'" alt="title" class="imagecheck-image">';
				html += '</figure>';
				html += '</label>';
				html += '</div>';
				$(".imagecheck-field").html(html);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).on("change", "#file", function() {
	 	readURL(this);
	 	$(this).val(null);
	});
</script>

@endsection

@section('css-extra')

<style type="text/css">
    .select2-container--default .select2-selection--single {border-color: #ebedf2; height: inherit; padding: .4rem 1rem;}
    .select2-container--default .select2-selection--single .select2-selection__arrow {height: 42px;}
</style>

@endsection