@extends('template/admin/template')

@section('title', 'Tentang Kami')

@section('head-extra')
   
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/ui/trumbowyg.min.css">
    
@endsection

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Tentang Kami</h4>
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
					<a href="#">Tentang Kami</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/tentang-kami/update">
						<div class="card-header">
							<div class="card-title">Tentang Kami</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $tentang_kami->id_tentang_kami }}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('konten_tentang_kami') ? 'has-error' : '' }}">
										<label for="konten">Konten</label>
										<textarea class="form-control" name="konten_tentang_kami">{!! $tentang_kami->konten_tentang_kami !!}</textarea>
                    					@if($errors->has('konten_tentang_kami'))
											<small id="error-konten" class="form-text text-danger">{{ ucfirst($errors->first('konten_tentang_kami')) }}</small>
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