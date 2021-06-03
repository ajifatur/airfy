<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// ADMIN Capabilities...
Route::group(['middleware' => ['admin']], function(){
	// Pages...
	Route::get('/admin', 'PageController@dashboard');

	// Route produk...
	Route::get('/admin/produk', 'ProdukController@index');
	Route::get('/admin/produk/tambah', 'ProdukController@create');
	Route::post('/admin/produk/store', 'ProdukController@store');
	Route::get('/admin/produk/edit/{id}', 'ProdukController@edit');
	Route::post('/admin/produk/update', 'ProdukController@update');
	Route::get('/admin/produk/delete/{id}', 'ProdukController@delete');

	// Route kategori...
	Route::get('/admin/kategori', 'KategoriController@index');
	Route::get('/admin/kategori/tambah', 'KategoriController@create');
	Route::post('/admin/kategori/store', 'KategoriController@store');
	Route::get('/admin/kategori/edit/{id}', 'KategoriController@edit');
	Route::post('/admin/kategori/update', 'KategoriController@update');
	Route::get('/admin/kategori/delete/{id}', 'KategoriController@delete');

	// Route pembelian...
	Route::get('/admin/pembelian/sukses', 'PembelianController@data_sukses');
	Route::get('/admin/pembelian/belum-diterima', 'PembelianController@data_belum_diterima');
	Route::get('/admin/pembelian/belum-dikirim', 'PembelianController@data_belum_dikirim');
	Route::get('/admin/pembelian/belum-diverifikasi', 'PembelianController@data_belum_diverifikasi');
	Route::get('/admin/pembelian/belum-dibayar', 'PembelianController@data_belum_dibayar');
	Route::get('/admin/pembelian/verify/{id}', 'PembelianController@verify');
	Route::post('/admin/pembelian/verification', 'PembelianController@verification');
	Route::get('/admin/pembelian/send/{id}', 'PembelianController@send');
	Route::post('/admin/pembelian/send-order', 'PembelianController@send_order');
	Route::get('/admin/pembelian/received/{id}', 'PembelianController@received');
	Route::post('/admin/pembelian/received-order', 'PembelianController@received_order');
	Route::get('/admin/pembelian/delete/{id}', 'PembelianController@delete');

	// Route bantuan...
	Route::get('/admin/bantuan', 'BantuanController@index');
	Route::get('/admin/bantuan/tambah', 'BantuanController@create');
	Route::post('/admin/bantuan/store', 'BantuanController@store');
	Route::get('/admin/bantuan/edit/{id}', 'BantuanController@edit');
	Route::post('/admin/bantuan/update', 'BantuanController@update');
	Route::get('/admin/bantuan/delete/{id}', 'BantuanController@delete');

	// Route user...
	Route::get('/admin/user', 'UserController@data_user');
	Route::get('/admin/user/tambah', 'UserController@create_user');
	Route::post('/admin/user/store', 'UserController@store_user');
	Route::get('/admin/user/edit/{id}', 'UserController@edit_user');
	Route::post('/admin/user/update', 'UserController@update_user');
	Route::get('/admin/user/delete/{id}', 'UserController@delete_user');

	// Route admin...
	Route::get('/admin/admin', 'UserController@data_admin');
	Route::get('/admin/admin/tambah', 'UserController@create_admin');
	Route::post('/admin/admin/store', 'UserController@store_admin');
	Route::get('/admin/admin/edit/{id}', 'UserController@edit_admin');
	Route::post('/admin/admin/update', 'UserController@update_admin');
	Route::get('/admin/admin/delete/{id}', 'UserController@delete_admin');

	// Route rekening...
	Route::get('/admin/rekening', 'RekeningController@index');
	Route::post('/admin/rekening/update', 'RekeningController@update');

	// Route kontak...
	Route::get('/admin/kontak', 'KontakController@index');
	Route::post('/admin/kontak/update', 'KontakController@update');

	// Route tentang kami...
	Route::get('/admin/tentang-kami', 'TentangKamiController@index');
	Route::post('/admin/tentang-kami/update', 'TentangKamiController@update');

	// AJAX...
	Route::get('/admin/produk/generate-price/{price}', 'ProdukController@generate_price');
	Route::get('/admin/produk/generate-stock/{stock}', 'ProdukController@generate_stock');
	Route::get('/admin/produk/increase-stock/{stock}', 'ProdukController@increase_stock');
	Route::get('/admin/produk/decrease-stock/{stock}', 'ProdukController@decrease_stock');

	// Logout...
	Route::post('/admin/logout', 'AdminLoginController@logout');
});


// USER Capabilities...
Route::group(['middleware' => ['user']], function(){
	// Profil user...
	Route::get('/profil', 'UserController@profile_user');
	Route::get('/profil/edit', 'UserController@edit_profile_user');
	Route::post('/profil/update', 'UserController@update_profile_user');

	// Wishlist...
	Route::get('/wishlist', 'WishlistController@show_wishlist');
	Route::get('/wishlist/tambah/{id}/{qty}', 'WishlistController@add_to_wishlist');
	Route::get('/wishlist/edit/{id}/{qty}', 'WishlistController@edit_wishlist');
	Route::get('/wishlist/delete/{id}', 'WishlistController@delete_from_wishlist');
	Route::post('/wishlist/add-to-cart', 'WishlistController@add_to_cart_from_wishlist');

	// Keranjang...
	Route::get('/keranjang', 'KeranjangController@show_cart');
	Route::get('/keranjang/tambah/{id}/{qty}', 'KeranjangController@add_to_cart');
	Route::get('/keranjang/edit/{id}/{qty}', 'KeranjangController@edit_cart');
	Route::get('/keranjang/delete/{id}', 'KeranjangController@delete_from_cart');

	// Checkout...
	Route::post('/checkout', 'KeranjangController@checkout');
	Route::post('/cek-ongkir', 'KeranjangController@get_ongkir');

	// Pembelian dan pembayaran...
	Route::get('/pembelian', 'PembelianController@user_purchases');
	Route::post('/pembelian/store', 'PembelianController@store');
	Route::get('/pembelian/confirm/{id}', 'PembelianController@add_payment_confirmation');
	Route::post('/pembelian/confirm/store', 'PembelianController@store_payment_confirmation');
	Route::get('/pembelian/confirm/edit/{id}', 'PembelianController@edit_payment_confirmation');
	Route::post('/pembelian/confirm/update', 'PembelianController@update_payment_confirmation');

	// AJAX...
	Route::get('/wishlist/generate-price/{price}', 'ProdukController@generate_price');
	Route::get('/keranjang/generate-price/{price}', 'ProdukController@generate_price');
	Route::get('/pembelian/generate-price/{price}', 'ProdukController@generate_price');

	// Logout...
	Route::post('/logout', 'AuthLoginController@logout');
});


// GUEST Capabilities...
Route::group(['middleware' => ['guest']], function(){
	// Pages...
	Route::get('/', 'PageController@home');

	// Route produk...
	Route::get('/shop', 'ProdukController@shop');
	Route::get('/shop/pencarian', 'ProdukController@shop_search');
	Route::get('/shop/{category_permalink}', 'ProdukController@shop_category');
	Route::get('/produk/{id}', 'ProdukController@show');

	// Route kontak...
	Route::get('/kontak', 'KontakController@contact');

	// Route tentang kami...
	Route::get('/tentang-kami', 'TentangKamiController@about_us');

	// Route bantuan...
	Route::get('/bantuan/{permalink}', 'BantuanController@show');

	// Admin Login...
	Route::get('/admin/login', 'AdminLoginController@showLoginForm');
	Route::post('/admin/login', 'AdminLoginController@login');

	// User Login...
	Route::get('/login', 'AuthLoginController@showLoginForm');
	Route::post('/login', 'AuthLoginController@login');

	// User Register...
	Route::get('/register', 'AuthRegisterController@showRegistrationForm');
	Route::post('/register', 'AuthRegisterController@register');
});