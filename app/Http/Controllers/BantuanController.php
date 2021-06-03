<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Bantuan;
use App\User;

class BantuanController extends Controller
{
    /**
     * Menampilkan data bantuan...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data bantuan...
        $bantuan = Bantuan::join('users','bantuan.author','=','users.id_user')->orderBy('bantuan.waktu_update','desc')->get();

        // View...
    	return view('bantuan/admin/index', ['bantuan' => $bantuan]);
    }

    /**
     * Menampilkan form untuk memasukkan data bantuan...
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View...
        return view('bantuan/admin/create');  
    }

    /**
     * Menyimpan bantuan ke database...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'judul_bantuan' => 'required',
            'konten_bantuan' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Membuat permalink
            $permalink = preg_replace('~[^0-9a-z\\s]~i', '', strtolower($request->judul_bantuan));
            $permalink = str_replace(' ', '-', $permalink);

            // Menyimpan data...
            $bantuan = new Bantuan;
            $bantuan->judul_bantuan = $request->judul_bantuan;
            $bantuan->permalink_bantuan = $permalink;
            $bantuan->konten_bantuan = htmlentities($request->konten_bantuan);
            $bantuan->author = Auth::user()->id_user;
            $bantuan->waktu_input = date('Y-m-d h:i:s');
            $bantuan->waktu_update = date('Y-m-d h:i:s');
            $bantuan->save();
        }

        // Redirect...
        return redirect('/admin/bantuan');
    }

    /**
     * Menampilkan form untuk mengedit data bantuan...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data bantuan berdasarkan $id
        $bantuan = Bantuan::find($id);

        // View...
        return view('bantuan/admin/edit', [
            'bantuan' => $bantuan
        ]);  
    }

    /**
     * Mengupdate data bantuan...
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
            'judul_bantuan' => 'required',
            'konten_bantuan' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Membuat permalink
            $permalink = preg_replace('~[^0-9a-z\\s]~i', '', strtolower($request->judul_bantuan));
            $permalink = str_replace(' ', '-', $permalink);

            // Menyimpan data...
            $bantuan = Bantuan::find($request->id);
            $bantuan->judul_bantuan = $request->judul_bantuan;
            $bantuan->permalink_bantuan = $permalink;
            $bantuan->konten_bantuan = htmlentities($request->konten_bantuan);
            $bantuan->author = Auth::user()->id_user;
            $bantuan->waktu_update = date('Y-m-d h:i:s');
            $bantuan->save();
        }

        // Redirect...
        return redirect('/admin/bantuan');
    }

    /**
     * Menghapus data bantuan...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Data bantuan berdasarkan $id
        $bantuan = Bantuan::find($id);

        // Menghapus data...
        if($bantuan->delete()){
        	echo "Berhasil menghapus data.";
        }
        else{
        	echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menampilkan detail bantuan...
     *
     * @param  string  $permalink
     * @return \Illuminate\Http\Response
     */
    public function show($permalink)
    {
        // Data bantuan berdasarkan permalink...
        $bantuan = Bantuan::where('permalink_bantuan','=',$permalink)->first();

        // Jika tidak ada data bantuan...
        if(!$bantuan){
        	abort(404);
        }
        // Jika ada bantuan...
        else{
        	$author = User::find($bantuan->author);
        	$bantuan->author = $author->nama;
        }

        // View...
        return view('bantuan/user/show', [
            'bantuan' => $bantuan
        ]);  
    }
}
