@extends('template/admin/template')

@section('title', 'Edit User')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Edit User</h4>
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
					<a href="#">User</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Edit User</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/user/update" enctype="multipart/form-data">
						<div class="card-header">
							<div class="card-title">Edit User</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $user->id_user }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
										<label for="nama">Nama</label>
										<input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{ $user->nama }}">
                    					@if($errors->has('nama'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email">Email</label>
										<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" value="{{ $user->email }}">
                    					@if($errors->has('email'))
											<small id="error-email" class="form-text text-danger">{{ ucfirst($errors->first('email')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
										<label for="password">Password</label>
										<input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
										<small id="text-muted-password" class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                    					@if($errors->has('password'))
											<small id="error-password" class="form-text text-danger">{{ ucfirst($errors->first('password')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
										<label for="password">Konfirmasi Password</label>
										<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukkan Konfirmasi Password">
										<small id="text-muted-password-confirmation" class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                    					@if($errors->has('password'))
											<small id="error-password-confirmation" class="form-text text-danger">{{ ucfirst($errors->first('password')) }}</small>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
										<label for="username">Username</label>
										<input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" value="{{ $user->username }}">
                    					@if($errors->has('username'))
											<small id="error-username" class="form-text text-danger">{{ ucfirst($errors->first('username')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('no_telepon') ? 'has-error' : '' }}">
										<label for="no_telepon">No. Telepon</label>
										<input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="Masukkan Nomor Telepon" value="{{ $user->no_telepon }}">
                    					@if($errors->has('no_telepon'))
											<small id="error-no_telepon" class="form-text text-danger">{{ ucfirst($errors->first('no_telepon')) }}</small>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Foto</label>
										<div class="row">
											<div class="col">
												<button class="btn btn-sm btn-primary btn-upload-img mr-2" data-toggle="tooltip" title="" data-original-title="Upload Foto">
													<i class="fa fa-upload"></i>
												</button>
											</div>
										</div>
										<input type="file" class="form-control-file d-none" id="file" accept="image/*">
										<div class="row mt-3 imagecheck-field">
											@if($user->foto != '')
												<div class="col-md-6 col-12 imagecheck-div">
													<label class="imagecheck mb-4">
														<input type="hidden" name="foto_src" value="">
														<figure class="imagecheck-figure">
															<img src="{{ asset('assets/images/user/'.$user->foto) }}" alt="title" class="imagecheck-image">
														</figure>
													</label>
												</div>
											@else
												<input type="hidden" name="foto_src" value="">
											@endif
										</div>
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

<script type="text/javascript">
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
				html += '<input type="hidden" name="foto_src" value="'+e.target.result+'">';
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