@extends('template/admin/template')

@section('title', 'Data User')

@section('content')

<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title">Data User</h4>
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
					<a href="#">Data User</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Data User</h4>
							<a class="btn btn-primary btn-round ml-auto" href="/admin/user/tambah">
								<i class="fa fa-plus"></i>
								Tambah User
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table" class="display table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th style="width: 40px">No.</th>
										<th>Nama</th>
										<th style="width: 100px">Username</th>
										<th style="width: 100px">Email</th>
										<th style="width: 50px">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									@foreach($user as $data)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $data->nama }}</td>
										<td>{{ $data->username }}</td>
										<td>{{ $data->email }}</td>
										<td>
											<div class="form-button-action">
												<a href="/admin/user/edit/{{ $data->id_user }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
													<i class="fa fa-edit"></i>
												</a>
												<a href="#" data-id="{{ $data->id_user }}" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-delete" data-original-title="Hapus">
													<i class="fa fa-trash"></i>
												</a>
											</div>
										</td>
									</tr>
									<?php $i++; ?>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-extra')

<script type="text/javascript">
	// DataTable...
	$(document).ready(function() {
		$("#table").DataTable();
	});

	// Menghapus data...
	$(document).on("click", ".btn-delete", function(e){
		e.preventDefault();
		var id = $(this).data("id");
		var ask = confirm("Anda yakin ingin menghapus data ini?");
		if(ask){
			$.ajax({
				type: "get",
				url: "/admin/user/delete/"+id,
				data: {id: id},
				success: function(response){
					if(response == "Berhasil menghapus data."){
						alert(response);
						window.location.href = '/admin/user';
					}
					else{
						alert(response);
					}
				}
			});
		}
	});
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.table td, .table th {padding: 0 15px!important; height: 40px;}
	.form-button-action .btn:first-child {padding: 0 .5rem 0 0;}
	.form-button-action .btn:last-child {padding: 0 0 0 .5rem;}
</style>

@endsection