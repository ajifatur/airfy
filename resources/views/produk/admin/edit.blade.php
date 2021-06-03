@extends('template/admin/template')

@section('title', 'Edit Produk')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Edit Produk</h4>
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
					<a href="#">Produk</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">Edit Produk</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/admin/produk/update" enctype="multipart/form-data">
						<div class="card-header">
							<div class="card-title">Edit Produk</div>
						</div>
						<div class="card-body">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $produk->id_produk }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group {{ $errors->has('nama_produk') ? 'has-error' : '' }}">
										<label for="nama">Nama Produk</label>
										<input type="text" name="nama_produk" class="form-control" id="nama" placeholder="Masukkan Nama Produk" value="{{ $produk->nama_produk }}">
                    					@if($errors->has('nama_produk'))
											<small id="error-nama" class="form-text text-danger">{{ ucfirst($errors->first('nama_produk')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('harga') ? 'has-error' : '' }}">
										<label for="harga">Harga</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Rp.</span>
											</div>
											<input type="text" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga" value="{{ number_format($produk->harga,0,',',',') }}" aria-label="harga" aria-describedby="basic-addon1">
										</div>
                    					@if($errors->has('harga'))
											<small id="error-harga" class="form-text text-danger">{{ ucfirst($errors->first('harga')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('stok') ? 'has-error' : '' }}">
										<label for="stok">Stok</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<button class="btn btn-border {{ $errors->has('stok') ? 'btn-danger' : '' }}" id="decrement" type="button">-</button>
											</div>
											<input type="text" name="stok" class="form-control" id="stok" placeholder="" value="{{ number_format($produk->stok,0,',',',') }}" aria-label="" aria-describedby="basic-addon2" style="text-align: center;" required>
											<div class="input-group-append">
												<button class="btn btn-border {{ $errors->has('stok') ? 'btn-danger' : '' }}" id="increment" type="button">+</button>
											</div>
										</div>
                    					@if($errors->has('stok'))
											<small id="error-stok" class="form-text text-danger">{{ ucfirst($errors->first('stok')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('berat') ? 'has-error' : '' }}">
										<label for="berat">Berat (gram)</label>
										<input type="number" name="berat" class="form-control" id="berat" placeholder="Masukkan Berat Produk" value="{{ $produk->berat }}">
                    					@if($errors->has('berat'))
											<small id="error-berat" class="form-text text-danger">{{ ucfirst($errors->first('berat')) }}</small>
										@endif
									</div>
									<div class="form-group {{ $errors->has('deskripsi_produk') ? 'has-error' : '' }}">
										<label for="deskripsi">Deskripsi</label>
										<textarea name="deskripsi_produk" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi Produk" rows="3">{{ $produk->deskripsi_produk }}</textarea>
                    					@if($errors->has('deskripsi_produk'))
											<small id="error-deskripsi" class="form-text text-danger">{{ ucfirst($errors->first('deskripsi_produk')) }}</small>
										@endif
									</div>
								</div>
								<div class="col-md-6">	
									<div class="form-group">
										<label class="form-label">Kategori</label>
										<div class="row">
											<div class="col">
												<div class="selectgroup selectgroup-pills">
													@foreach($kategori as $data)
													<label class="selectgroup-item">
														<input type="checkbox" name="kategori[]" value="{{ $data->id_kategori }}" class="selectgroup-input" {{ in_array($data->id_kategori, $produk->kategori_produk) ? 'checked' : '' }}>
														<span class="selectgroup-button">{{ $data->nama_kategori }}</span>
													</label>
													@endforeach
												</div>
											</div>
										</div>
									</div>			
									<div class="form-group">
										<label class="form-label">Gambar</label>
										<div class="row">
											<div class="col">
												<button class="btn btn-sm btn-primary btn-upload-img mr-2" data-toggle="tooltip" title="" data-original-title="Upload Gambar">
													<i class="fa fa-upload"></i>
												</button>
												<button class="btn btn-sm btn-danger btn-delete-img" data-toggle="tooltip" title="" data-original-title="Hapus Gambar">
													<i class="fa fa-trash"></i>
												</button>
											</div>
										</div>
										<input type="file" class="form-control-file d-none" id="file" accept="image/*">
										<div class="row mt-3 imagecheck-field">
											@foreach($produk->gambar_produk as $key=>$gambar)
											<div class="col-6 col-sm-4 imagecheck-div" data-id="{{ ($key+1) }}">
												<label class="imagecheck mb-4">
													<input name="gambar[]" type="checkbox" data-id="{{ ($key+1) }}" class="imagecheck-input">
													<input type="hidden" name="gambar_produk[]" value="{{ $gambar }}">
													<figure class="imagecheck-figure">
														<img src="{{ asset('assets/images/produk/'.$gambar) }}" alt="title" class="imagecheck-image">
													</figure>
												</label>
											</div>
											@endforeach
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
	// Format harga...
	$(document).on("change", "#harga", function(){
        var harga = $(this).val();
        harga = harga != '' ? harga : 0;
        $.ajax({
          type: "get",
          url: "/admin/produk/generate-price/"+harga,
          success: function(response){
            $("#harga").val(response);
          }
        });
    });

	// Format stok...
	$(document).on("change", "#stok", function(){
        var stok = $(this).val();
        stok = stok != '' ? stok : 0;
        $.ajax({
          type: "get",
          url: "/admin/produk/generate-stock/"+stok,
          success: function(response){
            $("#stok").val(response);
          }
        });
    });

	// Menambah stok...
	$(document).on("click", "#increment", function(){
        var stok = $("#stok").val();
        $.ajax({
          type: "get",
          url: "/admin/produk/increase-stock/"+stok,
          success: function(response){
            $("#stok").val(response);
          }
        });
    });

	// Mengurangi stok...
	$(document).on("click", "#decrement", function(){
        var stok = $("#stok").val();
        $.ajax({
          type: "get",
          url: "/admin/produk/decrease-stock/"+stok,
          success: function(response){
            $("#stok").val(response);
          }
        });
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
				html += '<div class="col-6 col-sm-4 imagecheck-div" data-id="'+(element.length+1)+'">';
				html += '<label class="imagecheck mb-4">';
				html += '<input name="gambar[]" type="checkbox" data-id="'+(element.length+1)+'" class="imagecheck-input">';
				html += '<input type="hidden" name="gambar_produk_src[]" value="'+e.target.result+'">';
				html += '<figure class="imagecheck-figure">';
				html += '<img src="'+e.target.result+'" alt="title" class="imagecheck-image">';
				html += '</figure>';
				html += '</label>';
				html += '</div>';
				$(".imagecheck-field").append(html);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).on("change", "#file", function() {
	 	readURL(this);
	 	$(this).val(null);
	});

    // Menghapus gambar terpilih...
    $(document).on("click", ".btn-delete-img", function(e){
    	e.preventDefault();
    	var element = $(".imagecheck-input:checked");
    	var count = element.length;
    	if(count > 0){
    		var ask = confirm(count + " gambar terpilih. Anda yakin ingin menghapusnya?");
    		if(ask){
		    	$.each(element, function(key,elem){
		    		var id = $(elem).data("id");
		    		$(".imagecheck-div[data-id='"+id+"']").remove();
		    	});
		    	var div = $(".imagecheck-div");
		    	$.each(div, function(key,elem){
		    		$(elem).attr("data-id",(key+1));
		    		$(elem).children().find(".imagecheck-input").attr("data-id",(key+1));
		    	});
    		}
    	}
    	else{
    		alert("Tidak ada gambar terpilih.");
    	}
    });
</script>

@endsection

@section('css-extra')

<style type="text/css">
	#decrement, #increment {border-color: #ebedf2!important; background-color: #e9ecef!important; color: black!important;}
</style>

@endsection