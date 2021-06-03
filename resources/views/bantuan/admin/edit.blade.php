@extends('template/admin/template')

@section('title', 'Edit Bantuan')

@section('head-extra')
   
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/ui/trumbowyg.min.css">
    
@endsection

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Edit Bantuan</h4>
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
					<a href="#">Bantuan</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Edit Bantuan</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/bantuan/update">
						<div class="card-header">
							<div class="card-title">Edit Bantuan</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $bantuan->id_bantuan }}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('judul_bantuan') ? 'has-error' : '' }}">
										<label for="judul">Judul</label>
										<input type="text" name="judul_bantuan" class="form-control" id="judul" placeholder="Masukkan Judul" value="{{ $bantuan->judul_bantuan }}">
                    					@if($errors->has('judul_bantuan'))
											<small id="error-judul" class="form-text text-danger">{{ ucfirst($errors->first('judul_bantuan')) }}</small>
										@endif
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('konten_bantuan') ? 'has-error' : '' }}">
										<label for="konten">Konten</label>
										<textarea class="form-control" name="konten_bantuan">{!! $bantuan->konten_bantuan !!}</textarea>
                    					@if($errors->has('konten_bantuan'))
											<small id="error-konten" class="form-text text-danger">{{ ucfirst($errors->first('konten_bantuan')) }}</small>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/trumbowyg.min.js"></script>
<script type="text/javascript">
	$(function(){
		// Trumbowyg pada textarea...
        $('textarea').trumbowyg();
	})
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.trumbowyg-box {margin-top: 0;}
</style>

@endsection