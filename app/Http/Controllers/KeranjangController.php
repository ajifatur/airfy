<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Keranjang;
use App\Kontak;
use App\Produk;
use App\Pengiriman;
use App\Rekening;

class KeranjangController extends Controller
{
    /**
     * Menampilkan keranjang...
     *
     * @return \Illuminate\Http\Response
     */
    public function show_cart()
    {
        // Data keranjang...
        $keranjang = Keranjang::where('id_user',Auth::user()->id_user)->where('sudah_dibeli','=',0)->where('waktu_input','>=',Carbon::now()->subHours(24))->first();

        // Jika ada data keranjang...
        if($keranjang){
	        // Data item dalam keranjang, subtotal, dan total...
		    $subtotal = $total = 0;
	        $item = json_decode($keranjang->keranjang, true);
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
    	return view('keranjang/user/index', [
    		'keranjang' => $keranjang,
    		'item' => $item,
    		'subtotal' => $subtotal,
    		'total' => $total
    	]);
    }

    /**
     * Menambah data ke keranjang...
     *
     * @param  int  $id
     * @param  int  $qty
     * @return \Illuminate\Http\Response
     */
    public function add_to_cart($id, $qty)
    {
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
	        if(!in_array($id, $ids)){
	        	array_push($item, array('p'=>$id, 'q'=>$qty));
	        }
        	$item = array_values($item);
        	$keranjang->keranjang = json_encode($item);
            $keranjang->waktu_update = date('Y-m-d h:i:s');
        	$keranjang->save();
        }
        // Jika tidak ada data keranjang...
        else{
        	// Membuat array data keranjang...
        	$item = array();
        	array_push($item, array('p'=>$id, 'q'=>$qty));
        	$item = array_values($item);

        	// Membuat data keranjang baru...
        	$keranjang = new Keranjang;
        	$keranjang->keranjang = json_encode($item);
        	$keranjang->id_user = Auth::user()->id_user;
            $keranjang->sudah_dibeli = 0;
            $keranjang->waktu_input = date('Y-m-d h:i:s');
            $keranjang->waktu_update = date('Y-m-d h:i:s');
        	$keranjang->save();
        }

        // Redirect...
        return redirect('/keranjang');
    }

    /**
     * Mengedit data keranjang...
     *
     * @param  int  $id
     * @param  int  $qty
     * @return \Illuminate\Http\Response
     */
    public function edit_cart($id, $qty)
    {
        // Data keranjang...
        $keranjang = Keranjang::where('id_user',Auth::user()->id_user)->where('sudah_dibeli','=',0)->where('waktu_input','>=',Carbon::now()->subHours(24))->first();

        // Data item dalam keranjang...
        $item = json_decode($keranjang->keranjang, true);
        foreach($item as $key=>$data){
            if($data['p'] === $id){
                $item[$key]['q'] = $qty;
            }
        }
        $item = array_values($item);
        echo json_encode($item);

        // Mengupdate data keranjang...
        $keranjang->keranjang = json_encode($item);
        $keranjang->waktu_update = date('Y-m-d h:i:s');
        $keranjang->save();
    }

    /**
     * Menghapus data dalam keranjang...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_from_cart($id)
    {
        // Data keranjang...
        $keranjang = Keranjang::where('id_user',Auth::user()->id_user)->where('sudah_dibeli','=',0)->where('waktu_input','>=',Carbon::now()->subHours(24))->first();

        // Data item dalam keranjang...
        $item = json_decode($keranjang->keranjang, true);
        foreach($item as $key=>$data){
        	if($data['p'] == $id){
        		unset($item[$key]);
        	}
        }
        $item = array_values($item);

        // Mengupdate data keranjang...
        $keranjang->keranjang = json_encode($item);
        $keranjang->waktu_update = date('Y-m-d h:i:s');
        if($keranjang->save()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menampilkan checkout...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        // Data berat...
        $berat = 0;

        // Data keranjang...
        $keranjang = Keranjang::find($request->id);
        $item = json_decode($keranjang->keranjang, true);
        if(count($item) > 0){
            foreach($item as $key=>$data){
                $produk = Produk::where('id_produk','=',$data['p'])->first();
                $item[$key]['n'] = $produk->nama_produk;
                $item[$key]['h'] = $produk->harga;
                $item[$key]['t'] = (int)$produk->harga * (int)$data['q'];

                $berat = $berat + ($produk->berat * $data['q']);
            }
        }

        // Data pengiriman...
        $pengiriman = Pengiriman::all();

        // Data subtotal dan total...
        $subtotal = $request->subtotal;
        $total = $request->total;

        // Data rekening...
        $rekening = Rekening::first();

        // View...
        return view('keranjang/user/checkout', [
            'berat' => $berat,
            'keranjang' => $keranjang,
            'item' => $item,
            'pengiriman' => $pengiriman,
            'rekening' => $rekening,
            'subtotal' => $subtotal,
            'total' => $total,
            'decode' => $this->rajaongkir()
        ]);
    }

    /**
     * Menampilkan data dari rajaongkir...
     *
     * @return \Illuminate\Http\Response
     */
    public function rajaongkir()
    {
        $key = "6c364815b9854774a772ec2f54e3607d";
        $url = "http://api.rajaongkir.com/starter/";

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url"."city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $key"
            )
        ));
        
        $response   = curl_exec($curl);
        $err        = curl_error($curl);
        curl_close($curl);
        $decode     = json_decode($response, true);
        
        foreach($decode['rajaongkir']['results'] as $key=>$data){
            if($key > 0 && $key < count($decode['rajaongkir']['results'])-1){
                $decode['rajaongkir']['results'][$key]['city_name_rev'] = $decode['rajaongkir']['results'][$key]['city_name'] == $decode['rajaongkir']['results'][$key-1]['city_name'] || $decode['rajaongkir']['results'][$key]['city_name'] == $decode['rajaongkir']['results'][$key+1]['city_name'] ? $decode['rajaongkir']['results'][$key]['city_name']." (".$decode['rajaongkir']['results'][$key]['type'].")" : $decode['rajaongkir']['results'][$key]['city_name'];
            }
            elseif($key == 0){
                $decode['rajaongkir']['results'][$key]['city_name_rev'] = $decode['rajaongkir']['results'][$key]['city_name'] == $decode['rajaongkir']['results'][$key+1]['city_name'] ? $decode['rajaongkir']['results'][$key]['city_name']." (".$decode['rajaongkir']['results'][$key]['type'].")" : $decode['rajaongkir']['results'][$key]['city_name'];
            }
            elseif($key == count($decode['rajaongkir']['results'])-1){
                $decode['rajaongkir']['results'][$key]['city_name_rev'] = $decode['rajaongkir']['results'][$key]['city_name'] == $decode['rajaongkir']['results'][$key-1]['city_name'] ? $decode['rajaongkir']['results'][$key]['city_name']." (".$decode['rajaongkir']['results'][$key]['type'].")" : $decode['rajaongkir']['results'][$key]['city_name'];
            }
        }

        return $decode;
    }
    
    /**
     * Mendapatkan ongkos kirim...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_ongkir(Request $request)
    {
        // Kota asal pengiriman...
        $kontak = Kontak::first();
        $asal = $kontak->kota_pengiriman;
        
        // Kota tujuan, berat, dan kurir...
        $tujuan = $request->tujuan;
        $berat = $request->berat;
        $kurir = $request->kurir;
        
        // CURL...
        $key = "6c364815b9854774a772ec2f54e3607d";
        $url = "http://api.rajaongkir.com/starter/";

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url"."cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=".$berat."&courier=".$kurir."",
            CURLOPT_HTTPHEADER => array(
                "key: $key"
            )
        ));
        
        $response   = curl_exec($curl);
        $err        = curl_error($curl);
        curl_close($curl);
        $decode     = json_decode($response, true);

        return $decode;
    }
}
