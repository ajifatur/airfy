<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kontak;

class KontakController extends Controller
{
    /**
     * Menampilkan form kontak...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data kontak...
        $kontak = Kontak::first();

        // View...
    	return view('kontak/admin/index', [
            'kontak' => $kontak,
            'decode' => $this->rajaongkir()
        ]);
    }

    /**
     * Mengupdate data kontak...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'kota_pengiriman' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
        	$nama_gambar = '';
            // Mengupload gambar jika ada gambar yang disubmit...
            if($request->logo_src != null || $request->logo_src != ''){
                list($type, $request->logo_src) = explode(';', $request->logo_src);
                list(, $request->logo_src)      = explode(',', $request->logo_src);
                $gambar = base64_decode($request->logo_src);
                $nama_gambar = time().'.png';
                file_put_contents('assets/images/logo/'.$nama_gambar, $gambar);
            }

            // Mengupdate data...
        	$kontak = Kontak::first();
            $kontak->nama_perusahaan = $request->nama_perusahaan;
            $kontak->alamat = $request->alamat;
            $kontak->email = $request->email;
            $kontak->no_telepon = $request->no_telepon;
            $kontak->kota_pengiriman = $request->kota_pengiriman;
            $kontak->logo_perusahaan = $nama_gambar != '' ? $nama_gambar : $kontak->logo_perusahaan;
            $kontak->waktu_update = date('Y-m-d h:i:s');
            $kontak->save();
        }

        // Redirect...
        return redirect('/admin/kontak');
    }

    /**
     * Menampilkan halaman kontak...
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        // Data kontak...
        $kontak = Kontak::first();

        // View...
    	return view('kontak/user/index', ['kontak' => $kontak]);
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
}
