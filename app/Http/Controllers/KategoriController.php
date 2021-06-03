<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan data kategori...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data kategori...
        $kategori = Kategori::orderBy('waktu_update','desc')->get();

        // View...
    	return view('kategori/admin/index', ['kategori' => $kategori]);
    }

    /**
     * Menampilkan form untuk memasukkan data kategori...
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View...
        return view('kategori/admin/create');  
    }

    /**
     * Menyimpan kategori ke database...
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
            'nama_kategori' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Membuat permalink
            $permalink = preg_replace('~[^0-9a-z\\s]~i', '', strtolower($request->nama_kategori));
            $permalink = str_replace(' ', '-', $permalink);

            // Menyimpan data...
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->permalink_kategori = $permalink;
            $kategori->waktu_input = date('Y-m-d h:i:s');
            $kategori->waktu_update = date('Y-m-d h:i:s');
            $kategori->save();
        }

        // Redirect...
        return redirect('/admin/kategori');
    }

    /**
     * Menampilkan form untuk mengedit data kategori...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data kategori berdasarkan $id
        $kategori = Kategori::find($id);

        // View...
        return view('kategori/admin/edit', [
            'kategori' => $kategori
        ]);  
    }

    /**
     * Mengupdate data kategori...
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
            'nama_kategori' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Membuat permalink
            $permalink = preg_replace('~[^0-9a-z\\s]~i', '', strtolower($request->nama_kategori));
            $permalink = str_replace(' ', '-', $permalink);

            // Mengupdate data...
            $kategori = Kategori::find($request->id);
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->permalink_kategori = $permalink;
            $kategori->waktu_update = date('Y-m-d h:i:s');
            $kategori->save();
        }

        // Redirect...
        return redirect('/admin/kategori');
    }

    /**
     * Menghapus data kategori...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Data kategori berdasarkan $id
        $kategori = Kategori::find($id);

        // Menghapus data...
        if($kategori->delete()){
        	echo "Berhasil menghapus data.";
        }
        else{
        	echo "Terjadi masalah dalam menghapus data.";
        }
    }
}
