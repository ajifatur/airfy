<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        @include('template/user/_head')
        <title>@yield('title') – {{ $var_kontak->nama_perusahaan }}</title>
        @yield('head-extra')
        @yield('css-extra')
    </head>
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        @include('template/user/_header')
        @yield('content')
        @include('template/user/_footer')
        @include('template/user/_modals')
        @include('template/user/_js')	
        @yield('js-extra')
    </body>
</html>
