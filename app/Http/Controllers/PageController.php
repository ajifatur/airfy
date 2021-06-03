<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class PageController extends Controller
{
    /**
     * Menampilkan halaman home...
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // Data produk...
        $produk = Produk::orderBy('waktu_update','desc')->limit(6)->get();
        foreach($produk as $data){
            $data->gambar_produk = explode(',', $data->gambar_produk);
        }

        // View...
    	return view('pages/user/home', [
            'produk' => $produk
        ]);
    }

    /**
     * Menampilkan halaman kontak...
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        // View...
        return view('pages/user/contact');
    }

    /**
     * Menampilkan halaman wishlist...
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlist()
    {
        // View...
    	return view('pages/user/wishlist');
    }

    /**
     * Menampilkan halaman keranjang...
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        // View...
    	return view('pages/user/cart');
    }

    /**
     * Menampilkan halaman checkout...
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // View...
    	return view('pages/user/checkout');
    }

    /**
     * Menampilkan halaman dashboard...
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // View...
        return view('pages/admin/dashboard');
    }
}
