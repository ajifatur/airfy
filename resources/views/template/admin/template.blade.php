<!DOCTYPE html>
<html lang="en">
<head>
	@include('template/admin/_head')
	<title>@yield('title') – {{ $var_kontak->nama_perusahaan }}</title>
	@yield('head-extra')
	@yield('css-extra')
</head>
<body>
	<div class="wrapper">
		@include('template/admin/_header')
		@include('template/admin/_sidebar')
		<div class="main-panel" style="background-color: #eeeeee;">
			@yield('content')
			@include('template/admin/_footer')
		</div>
		@include('template/admin/_custom-template')
	</div>
	@include('template/admin/_js')
	@yield('js-extra')
</body>
</html>