<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\TentangKami;
use App\User;

class TentangKamiController extends Controller
{
    /**
     * Menampilkan data tentang kami...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data tentang kami...
        $tentang_kami = TentangKami::join('users','tentang_kami.author','=','users.id_user')->first();

        // View...
    	return view('tentang-kami/admin/index', ['tentang_kami' => $tentang_kami]);
    }

    /**
     * Mengupdate data tentang kami...
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
            'konten_tentang_kami' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupdate data...
        	$tentang_kami = TentangKami::first();
            $tentang_kami->konten_tentang_kami = htmlentities($request->konten_tentang_kami);
            $tentang_kami->author = Auth::user()->id_user;
            $tentang_kami->waktu_update = date('Y-m-d h:i:s');
            $tentang_kami->save();
        }

        // Redirect...
        return redirect('/admin/tentang-kami');
    }

    /**
     * Menampilkan halaman tentang kami...
     *
     * @return \Illuminate\Http\Response
     */
    public function about_us()
    {
        // Data tentang kami...
        $tentang_kami = TentangKami::first();
        $author = User::find($tentang_kami->author);
        $tentang_kami->author = $author->nama;

        // View...
    	return view('tentang-kami/user/index', ['tentang_kami' => $tentang_kami]);
    }
}
