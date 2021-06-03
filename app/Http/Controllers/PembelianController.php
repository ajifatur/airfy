<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Pembelian;
use App\Pembayaran;
use App\Pengiriman;
use App\Keranjang;
use App\Produk;
use App\Rekening;
use App\User;

class PembelianController extends Controller
{
    /**
     * Menampilkan data pembelian (admin) belum dibayar...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_belum_dibayar()
    {
        // Data pembelian...
        $pembelian = Pembelian::where('sudah_dibayar','=',0)->orderBy('waktu_update','desc')->get();

        // Jika ada data pembelian...
        if(count($pembelian)>0){
            foreach($pembelian as $key=>$data){
                // Data user...
                $user = User::find($data->id_user);
                $pembelian[$key]->nama_user = $user->nama;

                // Data pembayaran...
                $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();
                $pembelian[$key]->sudah_terverifikasi = $pembayaran ? $pembayaran->sudah_terverifikasi : 0;

                // Data item dalam keranjang...
                $items = json_decode($data->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key2=>$data2){
                        $produk = Produk::where('id_produk','=',$data2['p'])->first();
                        $items[$key2]['n'] = $produk->nama_produk;
                    }
                    $data->keranjang = $items;
                }
            }
        }

        // View...
        return view('pembelian/admin/data_belum_dibayar', [
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Menampilkan data pembelian (admin) belum diverifikasi...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_belum_diverifikasi()
    {
        // Data pembelian...
        $pembelian = Pembelian::where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->orderBy('waktu_update','desc')->get();

        // Jika ada data pembelian...
        if(count($pembelian)>0){
            foreach($pembelian as $key=>$data){
                // Data user...
                $user = User::find($data->id_user);
                $pembelian[$key]->nama_user = $user->nama;

                // Data pembayaran...
                $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();

                // Jika pembayaran belum diverifikasi, data pembelian akan ditandai...
                if($pembayaran->sudah_terverifikasi == 0){
                    $pembelian[$key]->sudah_terverifikasi = $pembayaran->sudah_terverifikasi;
                }
                // Jika pembayaran sudah diverifikasi, akan menghapus data pembelian...
                else{
                    unset($pembelian[$key]);
                }

                // Data item dalam keranjang...
                $items = json_decode($data->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key2=>$data2){
                        $produk = Produk::where('id_produk','=',$data2['p'])->first();
                        $items[$key2]['n'] = $produk->nama_produk;
                    }
                    $data->keranjang = $items;
                }
            }
        }

        // View...
        return view('pembelian/admin/data_belum_diverifikasi', [
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Menampilkan data pembelian (admin) belum dikirim...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_belum_dikirim()
    {
        // Data pembelian...
        $pembelian = Pembelian::where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->orderBy('waktu_update','desc')->get();

        // Jika ada data pembelian...
        if(count($pembelian)>0){
            foreach($pembelian as $key=>$data){
                // Data user...
                $user = User::find($data->id_user);
                $pembelian[$key]->nama_user = $user->nama;

                // Data pembayaran...
                $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();

                // Jika pembayaran sudah diverifikasi, data pembelian akan ditandai...
                if($pembayaran->sudah_terverifikasi == 1){
                    $pembelian[$key]->sudah_terverifikasi = $pembayaran->sudah_terverifikasi;
                }
                // Jika pembayaran belum diverifikasi, akan menghapus data pembelian...
                else{
                    unset($pembelian[$key]);
                }

                // Data item dalam keranjang...
                $items = json_decode($data->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key2=>$data2){
                        $produk = Produk::where('id_produk','=',$data2['p'])->first();
                        $items[$key2]['n'] = $produk->nama_produk;
                    }
                    $data->keranjang = $items;
                }
            }
        }

        // View...
        return view('pembelian/admin/data_belum_dikirim', [
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Menampilkan data pembelian (admin) belum diterima...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_belum_diterima()
    {
        // Data pembelian...
        $pembelian = Pembelian::where('sudah_dibayar','=',1)->where('resi_pengiriman','!=','')->where('sudah_diterima','=',0)->orderBy('pembelian.waktu_update','desc')->get();

        // Jika ada data pembelian...
        if(count($pembelian)>0){
            foreach($pembelian as $key=>$data){
                // Data user...
                $user = User::find($data->id_user);
                $pembelian[$key]->nama_user = $user->nama;

                // Data pembayaran...
                $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();

                // Jika pembayaran sudah diverifikasi, data pembelian akan ditandai...
                if($pembayaran->sudah_terverifikasi == 1){
                    $pembelian[$key]->sudah_terverifikasi = $pembayaran->sudah_terverifikasi;
                }
                // Jika pembayaran belum diverifikasi, akan menghapus data pembelian...
                else{
                    unset($pembelian[$key]);
                }

                // Data item dalam keranjang...
                $items = json_decode($data->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key2=>$data2){
                        $produk = Produk::where('id_produk','=',$data2['p'])->first();
                        $items[$key2]['n'] = $produk->nama_produk;
                    }
                    $data->keranjang = $items;
                }

                // Data metode pengiriman
                $data->metode_pengiriman = json_decode($data->metode_pengiriman, true);
            }
        }

        // View...
        return view('pembelian/admin/data_belum_diterima', [
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Menampilkan data pembelian (admin) sukses...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_sukses()
    {
        // Data pembelian...
        $pembelian = Pembelian::where('sudah_dibayar','=',1)->where('sudah_diterima','=',1)->orderBy('waktu_update','desc')->get();

        // Jika ada data pembelian...
        if(count($pembelian)>0){
            foreach($pembelian as $key=>$data){
                // Data user...
                $user = User::find($data->id_user);
                $pembelian[$key]->nama_user = $user->nama;

                // Data pembayaran...
                $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();

                // Jika pembayaran sudah diverifikasi, data pembelian akan ditandai...
                if($pembayaran->sudah_terverifikasi == 1){
                    $pembelian[$key]->sudah_terverifikasi = $pembayaran->sudah_terverifikasi;
                }
                // Jika pembayaran belum diverifikasi, akan menghapus data pembelian...
                else{
                    unset($pembelian[$key]);
                }

                // Data item dalam keranjang...
                $items = json_decode($data->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key2=>$data2){
                        $produk = Produk::where('id_produk','=',$data2['p'])->first();
                        $items[$key2]['n'] = $produk->nama_produk;
                    }
                    $data->keranjang = $items;
                }
            }
        }

        // View...
        return view('pembelian/admin/data_sukses', [
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Memverifikasi pembayaran...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
    	// Data pembelian...
    	$pembelian = Pembelian::where('id_pembelian','=',$id)->where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->first();

        // Jika ada data pembelian...
        if($pembelian){
        	// Mengecek data pembayaran...
        	$pembayaran = Pembayaran::where('id_pembelian','=',$pembelian->id_pembelian)->where('sudah_terverifikasi','=',0)->first();

        	// Jika pembayaran belum diverifikasi...
        	if($pembayaran){
	        	// Data user...
	        	$user = User::find($pembelian->id_user);
	        	$pembelian->nama_user = $user->nama;

	        	// Data item dalam keranjang...
		        $items = json_decode($pembelian->keranjang, true);
			    if(count($items) > 0){
			        foreach($items as $key=>$data){
			        	$produk = Produk::where('id_produk','=',$data['p'])->first();
			        	$items[$key]['n'] = $produk->nama_produk;
			        }
			        $pembelian->keranjang = $items;
			    }

                // Data metode pengiriman
                $pembelian->metode_pengiriman = json_decode($pembelian->metode_pengiriman, true);
	        }
        	// Jika pembayaran sudah diverifikasi...
	        else{
	        	abort(404);
	        }
		}
        // Jika tidak ada data pembelian...
        else{
        	abort(404);
        }

    	// View...
    	return view('pembelian/admin/verify', [
    		'pembelian' => $pembelian,
    		'pembayaran' => $pembayaran,
    	]);
    }

    /**
     * Mensubmit verifikasi pembayaran...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request)
    {
    	// Data pembayaran...
    	$pembayaran = Pembayaran::find($request->id_pembayaran);
    	$pembayaran->sudah_terverifikasi = 1;
        $pembayaran->waktu_update = date('Y-m-d h:i:s');
        $pembayaran->save();

        // Redirect...
        return redirect('/admin/pembelian/belum-dikirim');
    }

    /**
     * Mengirim pesanan...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        // Data pembelian...
        $pembelian = Pembelian::where('id_pembelian','=',$id)->where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->first();

        // Data pengiriman...
        $pengiriman = Pengiriman::all();

        // Jika ada data pembelian...
        if($pembelian){
            // Mengecek data pembayaran...
            $pembayaran = Pembayaran::where('id_pembelian','=',$pembelian->id_pembelian)->where('sudah_terverifikasi','=',1)->first();

            // Jika pembayaran sudah diverifikasi...
            if($pembayaran){
                // Data user...
                $user = User::find($pembelian->id_user);
                $pembelian->nama_user = $user->nama;

                // Data item dalam keranjang...
                $items = json_decode($pembelian->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key=>$data){
                        $produk = Produk::where('id_produk','=',$data['p'])->first();
                        $items[$key]['n'] = $produk->nama_produk;
                    }
                    $pembelian->keranjang = $items;
                }

                // Data metode pengiriman
                $pembelian->metode_pengiriman = json_decode($pembelian->metode_pengiriman, true);
            }
            // Jika pembayaran belum diverifikasi...
            else{
                abort(404);
            }
        }
        // Jika tidak ada data pembelian...
        else{
            abort(404);
        }

        // View...
        return view('pembelian/admin/send', [
            'pembelian' => $pembelian,
            'pembayaran' => $pembayaran,
            'pengiriman' => $pengiriman,
        ]);
    }

    /**
     * Mensubmit pengiriman pesanan...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_order(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            // 'metode_pengiriman' => 'required',
            'resi_pengiriman' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Data pembelian...
            $pembelian = Pembelian::find($request->id_pembelian);
            // $pembelian->metode_pengiriman = $request->metode_pengiriman;
            $pembelian->resi_pengiriman = $request->resi_pengiriman;
            $pembelian->waktu_update = date('Y-m-d h:i:s');
            $pembelian->save();
        }

        // Redirect...
        return redirect('/admin/pembelian/belum-diterima');
    }

    /**
     * Konfirmasi pesanan telah diterima...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function received($id)
    {
        // Data pembelian...
        $pembelian = Pembelian::where('id_pembelian','=',$id)->where('sudah_dibayar','=',1)->where('resi_pengiriman','!=','')->where('sudah_diterima','=',0)->first();

        // Jika ada data pembelian...
        if($pembelian){
            // Mengecek data pembayaran...
            $pembayaran = Pembayaran::where('id_pembelian','=',$pembelian->id_pembelian)->where('sudah_terverifikasi','=',1)->first();

            // Jika pembayaran sudah diverifikasi...
            if($pembayaran){
                // Data user...
                $user = User::find($pembelian->id_user);
                $pembelian->nama_user = $user->nama;

                // Data item dalam keranjang...
                $items = json_decode($pembelian->keranjang, true);
                if(count($items) > 0){
                    foreach($items as $key=>$data){
                        $produk = Produk::where('id_produk','=',$data['p'])->first();
                        $items[$key]['n'] = $produk->nama_produk;
                    }
                    $pembelian->keranjang = $items;
                }
            }
            // Jika pembayaran belum diverifikasi...
            else{
                abort(404);
            }
        }
        // Jika tidak ada data pembelian...
        else{
            abort(404);
        }

        // View...
        return view('pembelian/admin/received', [
            'pembelian' => $pembelian,
            'pembayaran' => $pembayaran,
        ]);
    }

    /**
     * Mensubmit konfirmasi pesanan telah diterima...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function received_order(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'tanggal_diterima' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Data pembelian...
            $pembelian = Pembelian::find($request->id_pembelian);
            $pembelian->sudah_diterima = 1;
            $pembelian->tanggal_diterima = $request->tanggal_diterima;
            $pembelian->waktu_update = date('Y-m-d h:i:s');
            $pembelian->save();
        }

        // Redirect...
        return redirect('/admin/pembelian/sukses');
    }

    /**
     * Menampilkan data pembelian (user)...
     *
     * @return \Illuminate\Http\Response
     */
    public function user_purchases()
    {
    	// Data pembelian...
    	$pembelian = Pembelian::where('id_user',Auth::user()->id_user)->orderBy('id_pembelian','desc')->get();

        // Jika ada data keranjang...
        if(count($pembelian)>0){
	        foreach($pembelian as $key=>$data){
	        	// Data pembayaran...
	        	$pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();
	        	$pembelian[$key]->sudah_terverifikasi = $pembayaran ? $pembayaran->sudah_terverifikasi : 0;

	        	// Data item dalam keranjang...
		        $items = json_decode($data->keranjang, true);
			    if(count($items) > 0){
			        foreach($items as $key2=>$data2){
			        	$produk = Produk::where('id_produk','=',$data2['p'])->first();
			        	$items[$key2]['n'] = $produk->nama_produk;
			        }
			        $data->keranjang = $items;

                    // Data metode pengiriman
                    $data->metode_pengiriman = json_decode($data->metode_pengiriman, true);
			    }
			}
		}

        // Data rekening...
        $rekening = Rekening::first();

    	// View...
    	return view('pembelian/user/index', [
    		'pembelian' => $pembelian,
            'rekening' => $rekening,
    	]);
    }

    /**
     * Menyimpan pembelian ke database...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// Memasukkan request data keranjang ke variabel...
    	$p = $request->get('p');
    	$q = $request->get('q');
    	$h = $request->get('h');
    	$t = $request->get('t');

    	// Membuat array data keranjang...
    	$item = array();
    	foreach($p as $key=>$value){
    		array_push($item, array('p'=>$p[$key], 'q'=>$q[$key], 'h'=>$h[$key], 't'=>$t[$key]));
    	}
    	$item = array_values($item);

        // Metode pengiriman
        $metode_pengiriman['jenis'] = $request->metode_pengiriman;
        $metode_pengiriman['layanan'] = $request->service;

        // Menyimpan data...
        $pembelian = new Pembelian;
        $pembelian->keranjang = json_encode($item);
        $pembelian->id_user = Auth::user()->id_user;
        $pembelian->subtotal = $request->subtotal;
        $pembelian->ongkir = $request->ongkir;
        $pembelian->total = $request->total;
        $pembelian->sudah_dibayar = 0;
        $pembelian->alamat_pengiriman = $request->alamat_pengiriman;
        $pembelian->kota_pengiriman = $request->kota_pengiriman;
        $pembelian->kode_pos_pengiriman = $request->kode_pos_pengiriman;
        $pembelian->no_telp_pengiriman = $request->no_telp_pengiriman;
        $pembelian->metode_pengiriman = json_encode($metode_pengiriman);
        $pembelian->resi_pengiriman = "";
        $pembelian->sudah_diterima = 0;
        $pembelian->tanggal_diterima = null;
        $pembelian->waktu_input = date('Y-m-d h:i:s');
        $pembelian->waktu_update = date('Y-m-d h:i:s');
        $pembelian->save();

        // Mengubah data keranjang...
        $keranjang = Keranjang::find($request->id_keranjang);
        $keranjang->sudah_dibeli = 1;
        $keranjang->waktu_update = date('Y-m-d h:i:s');
        $keranjang->save();

        // Redirect...
        return redirect('/pembelian');
    }

    /**
     * Menampilkan form untuk mengonfirmasi pembayaran...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_payment_confirmation($id)
    {
    	// Mengecek apakah pembayaran sudah dikonfirmasi
    	$pembayaran = Pembayaran::where('id_pembelian','=',$id)->first();

    	// Jika belum dikonfirmasi...
    	if(!$pembayaran){
	    	// Data pembelian...
	    	$pembelian = Pembelian::where('id_pembelian','=',$id)->where('waktu_input','>=',Carbon::now()->subHours(24))->first();
            // Jika pembelian sudah tidak bisa dikonfirmasi...
            if(!$pembelian){
                abort(404);
            }
	    }
	    // Jika sudah dikonfirmasi...
	    else{
	    	abort(404);
	    }

    	// View...
    	return view('pembelian/user/add-payment-confirmation', ['pembelian' => $pembelian]);
    }

    /**
     * Melakukan konfirmasi pembayaran...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_payment_confirmation(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama_rekening' => 'required',
            'jumlah_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupload gambar jika ada gambar yang disubmit...
            $gambar = $request->bukti_pembayaran;
            list($type, $gambar) = explode(';', $gambar);
            list(, $gambar)      = explode(',', $gambar);
            $gambar = base64_decode($gambar);
            $nama_gambar = time().'.jpg';
            file_put_contents('assets/images/bukti-pembayaran/'.$nama_gambar, $gambar);

            // Menyimpan data...
            $pembayaran = new Pembayaran;
            $pembayaran->id_pembelian = $request->id;
            $pembayaran->nama_rekening = $request->nama_rekening;
            $pembayaran->jumlah_pembayaran = filter_var($request->jumlah_pembayaran, FILTER_SANITIZE_NUMBER_INT);
            $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
            $pembayaran->bukti_pembayaran = $nama_gambar;
            $pembayaran->sudah_terverifikasi = 0;
            $pembayaran->waktu_input = date('Y-m-d h:i:s');
            $pembayaran->waktu_update = date('Y-m-d h:i:s');
            $pembayaran->save();

        	// Mengubah data pembelian...
        	$pembelian = Pembelian::find($request->id);
        	$pembelian->sudah_dibayar = 1;
            $pembelian->waktu_update = date('Y-m-d h:i:s');
            $pembelian->save();
        }

        // Redirect...
        return redirect('/pembelian');
    }

    /**
     * Menampilkan form untuk mengedit konfirmasi pembayaran...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_payment_confirmation($id)
    {
    	// Mengecek apakah pembayaran sudah terverifikasi atau belum
    	$pembayaran = Pembayaran::where('id_pembelian','=',$id)->where('sudah_terverifikasi','=',0)->first();

    	// Jika belum terverifikasi...
    	if(!$pembayaran){
	    	abort(404);
	    }

    	// View...
    	return view('pembelian/user/edit-payment-confirmation', [
    		'pembayaran' => $pembayaran,
    	]);
    }

    /**
     * Mengupdate data konfirmasi pembayaran...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_payment_confirmation(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama_rekening' => 'required',
            'jumlah_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupload gambar jika ada gambar yang disubmit...
            $nama_gambar = '';
            if($request->bukti_pembayaran != null || $request->bukti_pembayaran != ''){
	            $gambar = $request->bukti_pembayaran;
	            list($type, $gambar) = explode(';', $gambar);
	            list(, $gambar)      = explode(',', $gambar);
	            $gambar = base64_decode($gambar);
	            $nama_gambar = time().'.jpg';
	            file_put_contents('assets/images/bukti-pembayaran/'.$nama_gambar, $gambar);
	        }

            // Menyimpan data...
            $pembayaran = Pembayaran::find($request->id);
            $pembayaran->id_pembelian = $request->id_pembelian;
            $pembayaran->nama_rekening = $request->nama_rekening;
            $pembayaran->jumlah_pembayaran = filter_var($request->jumlah_pembayaran, FILTER_SANITIZE_NUMBER_INT);
            $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
            $pembayaran->bukti_pembayaran = $nama_gambar != '' ? $nama_gambar : $pembayaran->bukti_pembayaran;
            $pembayaran->waktu_update = date('Y-m-d h:i:s');
            $pembayaran->save();
        }

        // Redirect...
        return redirect('/pembelian');
    }

    /**
     * Menghapus data pembelian...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Data pembelian berdasarkan $id
        $pembelian = Pembelian::find($id);

        // Menghapus data...
        if($pembelian->delete()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }
}
