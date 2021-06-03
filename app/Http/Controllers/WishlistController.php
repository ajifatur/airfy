<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Wishlist;
use App\Keranjang;
use App\Produk;

class WishlistController extends Controller
{
    /**
     * Menampilkan wishlist...
     *
     * @return \Illuminate\Http\Response
     */
    public function show_wishlist()
    {
        // Data wishlist...
        $wishlist = Wishlist::where('id_user',Auth::user()->id_user)->first();

        // Jika ada data wishlist...
        if($wishlist){
	        // Data item dalam wishlist, subtotal, dan total...
		    $subtotal = $total = 0;
	        $item = json_decode($wishlist->wishlist, true);
		    if(count($item) > 0){
		        foreach($item as $key=>$data){
		        	$produk = Produk::where('id_produk','=',$data['p'])->first();
		        	$gambar_produk = $produk->gambar_produk != '' ? explode(',', $produk->gambar_produk) : array();
		        	$item[$key]['g'] = $gambar_produk[0];
		        	$item[$key]['n'] = $produk->nama_produk;
                    $item[$key]['qmax'] = $produk->stok;
		        	$item[$key]['h'] = $produk->harga;
		        	$item[$key]['t'] = (int)$produk->harga * (int)$data['q'];
		        	$subtotal += $item[$key]['t'];
		        	$total = $subtotal;
		        }
		    }
		}
		// Jika tidak ada...
		else{
			// Data item, total, dan subtotal...
			$item = array();
		    $subtotal = $total = 0;
		}

        // View...
    	return view('wishlist/user/index', [
    		'wishlist' => $wishlist,
    		'item' => $item,
    		'subtotal' => $subtotal,
    		'total' => $total
    	]);
    }

    /**
     * Menambah data ke wishlist...
     *
     * @param  int  $id
     * @param  int  $qty
     * @return \Illuminate\Http\Response
     */
    public function add_to_wishlist($id, $qty)
    {
        // Data wishlist...
        $wishlist = Wishlist::where('id_user',Auth::user()->id_user)->first();

        // Jika ada data wishlist...
        if($wishlist){
        	// Menambah produk ke dalam wishlist...
        	$ids = array();
        	$item = json_decode($wishlist->wishlist, true);
	        foreach($item as $key=>$data){
	        	array_push($ids, $data['p']);
	        }
	        if(!in_array($id, $ids)){
	        	array_push($item, array('p'=>$id, 'q'=>$qty));
	        }
        	$item = array_values($item);
        	$wishlist->wishlist = json_encode($item);
            $wishlist->waktu_update = date('Y-m-d h:i:s');
        	$wishlist->save();
        }
        // Jika tidak ada data wishlist...
        else{
        	// Membuat array data wishlist...
        	$item = array();
        	array_push($item, array('p'=>$id, 'q'=>$qty));
        	$item = array_values($item);

        	// Membuat data wishlist baru...
        	$wishlist = new Wishlist;
        	$wishlist->wishlist = json_encode($item);
        	$wishlist->id_user = Auth::user()->id_user;
            $wishlist->waktu_input = date('Y-m-d h:i:s');
            $wishlist->waktu_update = date('Y-m-d h:i:s');
        	$wishlist->save();
        }

        // Redirect...
        return redirect('/wishlist');
    }

    /**
     * Mengedit data wishlist...
     *
     * @param  int  $id
     * @param  int  $qty
     * @return \Illuminate\Http\Response
     */
    public function edit_wishlist($id, $qty)
    {
        // Data wishlist...
        $wishlist = Wishlist::where('id_user',Auth::user()->id_user)->first();

        // Data item dalam wishlist...
        $item = json_decode($wishlist->wishlist, true);
        foreach($item as $key=>$data){
            if($data['p'] === $id){
                $item[$key]['q'] = $qty;
            }
        }
        $item = array_values($item);
        echo json_encode($item);

        // Mengupdate data wishlist...
        $wishlist->wishlist = json_encode($item);
        $wishlist->waktu_update = date('Y-m-d h:i:s');
        $wishlist->save();
    }

    /**
     * Menghapus data dalam wishlist...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_from_wishlist($id)
    {
        // Data wishlist...
        $wishlist = Wishlist::where('id_user',Auth::user()->id_user)->first();

        // Data item dalam wishlist...
        $item = json_decode($wishlist->wishlist, true);
        foreach($item as $key=>$data){
        	if($data['p'] == $id){
        		unset($item[$key]);
        	}
        }
        $item = array_values($item);

        // Mengupdate data wishlist...
        $wishlist->wishlist = json_encode($item);
        $wishlist->waktu_update = date('Y-m-d h:i:s');
        if($wishlist->save()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menambahkan data dalam wishlist ke keranjang...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_to_cart_from_wishlist(Request $request)
    {
        // Data wishlist...
        $wishlist = Wishlist::where('id_user',Auth::user()->id_user)->first();

        // Data item dalam wishlist...
        $item = json_decode($wishlist->wishlist, true);
        foreach($item as $key=>$data){
            if($data['p'] == $request->id){
                $idp = $item[$key]['p'];
                $qty = $item[$key]['q'];
                unset($item[$key]);
            }
        }
        $item = array_values($item);

        // Mengupdate data wishlist...
        $wishlist->wishlist = json_encode($item);
        $wishlist->waktu_update = date('Y-m-d h:i:s');
        $wishlist->save();

        // Data keranjang...
        $keranjang = Keranjang::where('id_user',Auth::user()->id_user)->where('sudah_dibeli','=',0)->where('waktu_input','>=',Carbon::now()->subHours(24))->first();

        // Jika ada data keranjang...
        if($keranjang){
            // Menambah produk ke dalam keranjang...
            $ids = array();
            $item = json_decode($keranjang->keranjang, true);
            foreach($item as $key=>$data){
                array_push($ids, $data['p']);
            }
            if(!in_array($idp, $ids)){
                array_push($item, array('p'=>$idp, 'q'=>$qty));
            }
            else{
                $produk = Produk::where('id_produk','=',$idp)->first();
                $item[$key]['q'] = (int)$item[$key]['q'] + (int)$qty;
                $item[$key]['q'] = $item[$key]['q'] > $produk->stok ? $produk->stok : $item[$key]['q'];
            }
            $item = array_values($item);
            $keranjang->keranjang = json_encode($item);
            $keranjang->waktu_update = date('Y-m-d h:i:s');
        }
        // Jika tidak ada data keranjang...
        else{
            // Membuat array data keranjang...
            $item = array();
            array_push($item, array('p'=>$idp, 'q'=>$qty));
            $item = array_values($item);

            // Membuat data keranjang baru...
            $keranjang = new Keranjang;
            $keranjang->keranjang = json_encode($item);
            $keranjang->id_user = Auth::user()->id_user;
            $keranjang->sudah_dibeli = 0;
            $keranjang->waktu_input = date('Y-m-d h:i:s');
            $keranjang->waktu_update = date('Y-m-d h:i:s');
        }

        if($keranjang->save()){
            echo "Berhasil menambahkan data ke keranjang.";
        }
        else{
            echo "Terjadi masalah dalam menambahkan data ke keranjang.";
        }
    }
}
