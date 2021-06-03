<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Pengiriman;

class PengirimanController extends Controller
{
    /**
     * Menampilkan data pengiriman...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data pengiriman...
        $pengiriman = Pengiriman::orderBy('pengiriman','asc')->get();

        // View...
    	return view('pengiriman/admin/index', ['pengiriman' => $pengiriman]);
    }

    /**
     * Menampilkan form untuk memasukkan data pengiriman...
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View...
        return view('pengiriman/admin/create');  
    }

    /**
     * Menyimpan pengiriman ke database...
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
            'pengiriman' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Menyimpan data...
            $pengiriman = new Pengiriman;
            $pengiriman->pengiriman = $request->pengiriman;
            $pengiriman->waktu_input = date('Y-m-d h:i:s');
            $pengiriman->waktu_update = date('Y-m-d h:i:s');
            $pengiriman->save();
        }

        // Redirect...
        return redirect('/admin/pengiriman');
    }

    /**
     * Menampilkan form untuk mengedit data pengiriman...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data pengiriman berdasarkan $id
        $pengiriman = Pengiriman::find($id);

        // View...
        return view('pengiriman/admin/edit', [
            'pengiriman' => $pengiriman
        ]);  
    }

    /**
     * Mengupdate data pengiriman...
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
            'pengiriman' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupdate data...
            $pengiriman = Pengiriman::find($request->id);
            $pengiriman->pengiriman = $request->pengiriman;
            $pengiriman->waktu_update = date('Y-m-d h:i:s');
            $pengiriman->save();
        }

        // Redirect...
        return redirect('/admin/pengiriman');
    }

    /**
     * Menghapus data pengiriman...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Data pengiriman berdasarkan $id
        $pengiriman = Pengiriman::find($id);

        // Menghapus data...
        if($pengiriman->delete()){
        	echo "Berhasil menghapus data.";
        }
        else{
        	echo "Terjadi masalah dalam menghapus data.";
        }
    }
}
