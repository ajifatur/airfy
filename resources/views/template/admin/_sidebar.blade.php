		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							@if(Auth::user()->foto != '')
							<img src="{{ asset('assets/images/admin/'.Auth::user()->foto) }}" alt="..." class="avatar-img rounded-circle">
							@else
							<img src="{{ asset('assets/images/admin/default.png') }}" alt="..." class="avatar-img rounded-circle">
							@endif
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->nama }}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="/admin">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Data</h4>
						</li>
						<li class="nav-item">
							<a href="/admin/produk">
								<i class="fas fa-shopping-bag"></i>
								<p>Produk</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/kategori">
								<i class="fas fa-tags"></i>
								<p>Kategori</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#pembelian">
								<i class="fas fa-money-bill"></i>
								<p>Pembelian</p>
								@if($var_total_pembelian_belum_tuntas > 0)
								<span class="badge badge-danger">{{ $var_total_pembelian_belum_tuntas }}</span>
								@endif
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pembelian">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/pembelian/sukses">
											<span class="sub-item">Sukses</span>
										</a>
									</li>
									<li>
										<a href="/admin/pembelian/belum-diterima">
											<span class="sub-item">Belum Diterima</span>
											@if($var_pembelian_belum_diterima > 0)
											<span class="badge badge-danger">{{ $var_pembelian_belum_diterima }}</span>
											@endif
										</a>
									</li>
									<li>
										<a href="/admin/pembelian/belum-dikirim">
											<span class="sub-item">Belum Dikirim</span>
											@if($var_pembelian_belum_dikirim > 0)
											<span class="badge badge-danger">{{ $var_pembelian_belum_dikirim }}</span>
											@endif
										</a>
									</li>
									<li>
										<a href="/admin/pembelian/belum-diverifikasi">
											<span class="sub-item">Belum Diverifikasi</span>
											@if($var_pembelian_belum_diverifikasi > 0)
											<span class="badge badge-danger">{{ $var_pembelian_belum_diverifikasi }}</span>
											@endif
										</a>
									</li>
									<li>
										<a href="/admin/pembelian/belum-dibayar">
											<span class="sub-item">Belum Dibayar</span>
											@if($var_pembelian_belum_dibayar > 0)
											<span class="badge badge-danger">{{ $var_pembelian_belum_dibayar }}</span>
											@endif
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="/admin/bantuan">
								<i class="fas fa-question"></i>
								<p>Bantuan</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/user">
								<i class="fas fa-users"></i>
								<p>User</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/admin">
								<i class="fas fa-user-secret"></i>
								<p>Admin</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Pengaturan</h4>
						</li>
						<li class="nav-item">
							<a href="/admin/rekening">
								<i class="fas fa-money-check"></i>
								<p>Rekening</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/kontak">
								<i class="fas fa-phone"></i>
								<p>Kontak</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/tentang-kami">
								<i class="fas fa-info"></i>
								<p>Tentang Kami</p>
								<!-- <span class="badge badge-success">4</span> -->
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>