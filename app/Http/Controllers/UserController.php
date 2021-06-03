<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{
    /**
     * Menampilkan data user...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_user()
    {
        // Data user...
        $user = User::where('role','=',2)->orderBy('waktu_update','desc')->get();

        // View...
    	return view('user/admin/data_user', ['user' => $user]);
    }

    /**
     * Menampilkan form untuk memasukkan data user...
     *
     * @return \Illuminate\Http\Response
     */
    public function create_user()
    {
        // View...
    	return view('user/admin/create_user');  
    }

    /**
     * Menyimpan user ke database...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_user(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|string|min:6|max:255|unique:users',
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
            if($request->foto_src != null || $request->foto_src != ''){
                list($type, $request->foto_src) = explode(';', $request->foto_src);
                list(, $request->foto_src)      = explode(',', $request->foto_src);
                $gambar = base64_decode($request->foto_src);
                $nama_gambar = time().'.jpg';
                file_put_contents('assets/images/user/'.$nama_gambar, $gambar);
            }

            // Menyimpan data...
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->no_telepon = $request->no_telepon != null ? $request->no_telepon : '';
            $user->foto = $nama_gambar != '' ? $nama_gambar : '';
            $user->role = 2;
            $user->waktu_input = date('Y-m-d h:i:s');
            $user->waktu_update = date('Y-m-d h:i:s');
            $user->save();
        }

        // Redirect...
        return redirect('/admin/user');
    }

    /**
     * Menampilkan form untuk mengedit data user...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_user($id)
    {
        // Data user berdasarkan $id
        $user = User::find($id);

        // View...
        return view('user/admin/edit_user', ['user' => $user]);  
    }

    /**
     * Mengupdate data user...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
            	'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
            'password' => 'confirmed',
            'username' => [
            	'required', 'string', 'min:6', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
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
            if($request->foto_src != null || $request->foto_src != ''){
                list($type, $request->foto_src) = explode(';', $request->foto_src);
                list(, $request->foto_src)      = explode(',', $request->foto_src);
                $gambar = base64_decode($request->foto_src);
                $nama_gambar = time().'.jpg';
                file_put_contents('assets/images/user/'.$nama_gambar, $gambar);
            }

            // Menyimpan data...
            $user = User::find($request->id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password != null ? bcrypt($request->password) : $user->password;
            $user->no_telepon = $request->no_telepon != null ? $request->no_telepon : '';
            $user->foto = $nama_gambar != '' ? $nama_gambar : $user->foto;
            $user->waktu_update = date('Y-m-d h:i:s');
            $user->save();
        }

        // Redirect...
        return redirect('/admin/user');
    }

    /**
     * Menghapus data user...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_user($id)
    {
        // Data user berdasarkan $id
        $user = User::find($id);

        // Menghapus data...
        if($user->delete()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menampilkan data admin...
     *
     * @return \Illuminate\Http\Response
     */
    public function data_admin()
    {
        // Data admin...
        $admin = User::where('role','=',1)->orderBy('waktu_update','desc')->get();

        // View...
    	return view('user/admin/data_admin', ['admin' => $admin]);
    }

    /**
     * Menampilkan form untuk memasukkan data admin...
     *
     * @return \Illuminate\Http\Response
     */
    public function create_admin()
    {
        // View...
    	return view('user/admin/create_admin');  
    }

    /**
     * Menyimpan admin ke database...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_admin(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|string|min:6|max:255|unique:users',
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
            if($request->foto_src != null || $request->foto_src != ''){
                list($type, $request->foto_src) = explode(';', $request->foto_src);
                list(, $request->foto_src)      = explode(',', $request->foto_src);
                $gambar = base64_decode($request->foto_src);
                $nama_gambar = time().'.jpg';
                file_put_contents('assets/images/admin/'.$nama_gambar, $gambar);
            }

            // Menyimpan data...
            $admin = new User;
            $admin->nama = $request->nama;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->no_telepon = $request->no_telepon != null ? $request->no_telepon : '';
            $admin->foto = $nama_gambar != '' ? $nama_gambar : '';
            $admin->role = 1;
            $admin->waktu_input = date('Y-m-d h:i:s');
            $admin->waktu_update = date('Y-m-d h:i:s');
            $admin->save();
        }

        // Redirect...
        return redirect('/admin/admin');
    }

    /**
     * Menampilkan form untuk mengedit data admin...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_admin($id)
    {
        // Data admin berdasarkan $id
        $admin = User::find($id);

        // View...
        return view('user/admin/edit_admin', ['admin' => $admin]);  
    }

    /**
     * Mengupdate data admin...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_admin(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
            	'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
            'password' => 'confirmed',
            'username' => [
            	'required', 'string', 'min:6', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
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
            if($request->foto_src != null || $request->foto_src != ''){
                list($type, $request->foto_src) = explode(';', $request->foto_src);
                list(, $request->foto_src)      = explode(',', $request->foto_src);
                $gambar = base64_decode($request->foto_src);
                $nama_gambar = time().'.jpg';
                file_put_contents('assets/images/admin/'.$nama_gambar, $gambar);
            }

            // Menyimpan data...
            $admin = User::find($request->id);
            $admin->nama = $request->nama;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->password = $request->password != null ? bcrypt($request->password) : $admin->password;
            $admin->no_telepon = $request->no_telepon != null ? $request->no_telepon : '';
            $admin->foto = $nama_gambar != '' ? $nama_gambar : $admin->foto;
            $admin->waktu_update = date('Y-m-d h:i:s');
            $admin->save();
        }

        // Redirect...
        return redirect('/admin/admin');
    }

    /**
     * Menghapus data admin...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_admin($id)
    {
        // Data admin berdasarkan $id
        $admin = User::find($id);

        // Menghapus data...
        if($admin->delete()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menampilkan profil user...
     *
     * @return \Illuminate\Http\Response
     */
    public function profile_user()
    {
        // View...
        return view('user/user/profile');  
    }

    /**
     * Menampilkan form untuk mengedit profil user...
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_profile_user()
    {
        // View...
        return view('user/user/edit');  
    }

    /**
     * Mengupdate data profil user...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_profile_user(Request $request)
    {
        // Pesan Error...
        $messages = [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute wajib dengan nomor atau angka.',
            'unique' => ':attribute sudah ada.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'Konfirmasi password tidak sesuai.',
        ];

        // Validasi...
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
            'password' => 'confirmed',
            'username' => [
                'required', 'string', 'min:6', 'max:255', Rule::unique('users')->ignore($request->id, 'id_user')
            ],
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
            if($request->foto != null || $request->foto != ''){
                list($type, $request->foto) = explode(';', $request->foto);
                list(, $request->foto)      = explode(',', $request->foto);
                $gambar = base64_decode($request->foto);
                $nama_gambar = time().'.jpg';
                file_put_contents('assets/images/user/'.$nama_gambar, $gambar);
            }

            // Menyimpan data...
            $user = User::find($request->id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password != null ? bcrypt($request->password) : $user->password;
            $user->no_telepon = $request->no_telepon != null ? $request->no_telepon : '';
            $user->foto = $nama_gambar != '' ? $nama_gambar : $user->foto;
            $user->waktu_update = date('Y-m-d h:i:s');
            $user->save();
        }

        // Redirect...
        return redirect('/profil');
    }
}