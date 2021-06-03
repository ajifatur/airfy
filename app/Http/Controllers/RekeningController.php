<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rekening;

class RekeningController extends Controller
{
    /**
     * Menampilkan form rekening...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data rekening...
        $rekening = Rekening::first();

        // View...
    	return view('rekening/admin/index', ['rekening' => $rekening]);
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
            'bank' => 'required|max:100',
            'nama_rekening' => 'required|max:100',
            'nomor_rekening' => 'required|max:100',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupdate data...
        	$rekening = Rekening::first();
            $rekening->bank = $request->bank;
            $rekening->nama_rekening = $request->nama_rekening;
            $rekening->nomor_rekening = $request->nomor_rekening;
            $rekening->waktu_update = date('Y-m-d h:i:s');
            $rekening->save();
        }

        // Redirect...
        return redirect('/admin/rekening');
    }
}
