<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Menampilkan data produk...
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data produk...
        $produk = Produk::orderBy('waktu_update','desc')->get();

        // View...
    	return view('produk/admin/index', ['produk' => $produk]);
    }

    /**
     * Menampilkan form untuk memasukkan data produk...
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Data kategori...
        $kategori = Kategori::all();

        // View...
    	return view('produk/admin/create', ['kategori' => $kategori]);  
    }

    /**
     * Menyimpan produk ke database...
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
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'berat' => 'required|numeric',
            'deskripsi_produk' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupload gambar jika ada gambar yang disubmit...
            $array_gambar = !empty($request->get('gambar_produk')) ? $request->gambar_produk : array();
            if(!empty($request->get('gambar_produk_src'))){
                foreach($request->gambar_produk_src as $key=>$gambar){
                    if($gambar != '' || $gambar != null){
                        list($type, $gambar) = explode(';', $gambar);
                        list(, $gambar)      = explode(',', $gambar);
                        $gambar = base64_decode($gambar);
                        $nama_gambar = time().'_'.($key+1).'.jpg';
                        file_put_contents('assets/images/produk/'.$nama_gambar, $gambar);
                        array_push($array_gambar, $nama_gambar);
                    }
                }
            }

            // Menyimpan data...
            $produk = new Produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi_produk = $request->deskripsi_produk;
            $produk->kategori_produk = !empty($request->get('kategori')) ? implode(',', $request->kategori) : '';
            $produk->harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
            $produk->stok = filter_var($request->stok, FILTER_SANITIZE_NUMBER_INT);
            $produk->berat = filter_var($request->berat, FILTER_SANITIZE_NUMBER_INT);
            $produk->gambar_produk = implode(',', $array_gambar);
            $produk->waktu_input = date('Y-m-d h:i:s');
            $produk->waktu_update = date('Y-m-d h:i:s');
            $produk->save();
        }

        // Redirect...
        return redirect('/admin/produk');
    }

    /**
     * Menampilkan form untuk mengedit data produk...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data produk berdasarkan $id
        $produk = Produk::find($id);
        $produk->kategori_produk = explode(',', $produk->kategori_produk);
        $produk->gambar_produk = explode(',', $produk->gambar_produk);

        // Data kategori...
        $kategori = Kategori::all();

        // View...
        return view('produk/admin/edit', [
            'produk' => $produk,
            'kategori' => $kategori
        ]);  
    }

    /**
     * Mengupdate data produk...
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
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'berat' => 'required|numeric',
            'deskripsi_produk' => 'required',
        ], $messages);
        
        // Mengecek jika ada error...
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error...
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Jika tidak ada error...
        else{
            // Mengupload gambar jika ada gambar yang disubmit...
            $array_gambar = !empty($request->get('gambar_produk')) ? $request->gambar_produk : array();
            if(!empty($request->get('gambar_produk_src'))){
                foreach($request->gambar_produk_src as $key=>$gambar){
                    if($gambar != '' || $gambar != null){
                        list($type, $gambar) = explode(';', $gambar);
                        list(, $gambar)      = explode(',', $gambar);
                        $gambar = base64_decode($gambar);
                        $nama_gambar = time().'_'.($key+1).'.jpg';
                        file_put_contents('assets/images/produk/'.$nama_gambar, $gambar);
                        array_push($array_gambar, $nama_gambar);
                    }
                }
            }

            // Mengupdate data...
            $produk = Produk::find($request->id);
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi_produk = $request->deskripsi_produk;
            $produk->kategori_produk = !empty($request->get('kategori')) ? implode(',', $request->kategori) : '';
            $produk->harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
            $produk->stok = filter_var($request->stok, FILTER_SANITIZE_NUMBER_INT);
            $produk->berat = filter_var($request->berat, FILTER_SANITIZE_NUMBER_INT);
            $produk->gambar_produk = implode(',', $array_gambar);
            $produk->waktu_update = date('Y-m-d h:i:s');
            $produk->save();
        }

        // Redirect...
        return redirect('/admin/produk');
    }

    /**
     * Menghapus data produk...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Data produk berdasarkan $id
        $produk = Produk::find($id);

        // Menghapus data...
        if($produk->delete()){
            echo "Berhasil menghapus data.";
        }
        else{
            echo "Terjadi masalah dalam menghapus data.";
        }
    }

    /**
     * Menampilkan data produk dalam "toko"...
     *
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        // Data produk...
        $produk = Produk::orderBy('waktu_update','desc')->paginate(12);
        foreach($produk as $data){
            $data->gambar_produk = explode(',', $data->gambar_produk);
        }

        // Data kategori...
        $kategori = Kategori::orderBy('nama_kategori','asc')->limit(5)->get();

        // View...
        return view('produk/user/shop', [
            'produk' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Menampilkan data produk dalam "toko" berdasarkan kategori...
     *
     * @param  string  $permalink
     * @return \Illuminate\Http\Response
     */
    public function shop_category($permalink)
    {
        // Data kategori berdasarkan permalink
        $kategori_produk = Kategori::where('permalink_kategori','=',$permalink)->first();

        // Data produk sesuai kategori...
        $ids = array();
        $produk = Produk::orderBy('waktu_update','desc')->paginate(12);
        foreach($produk as $data){
            $data->kategori_produk = explode(',', $data->kategori_produk);
            $data->gambar_produk = explode(',', $data->gambar_produk);
            if(!in_array($kategori_produk->id_kategori, $data->kategori_produk)){
                array_push($ids, $data->id_produk);
            }
        }
        foreach($ids as $id){
            foreach($produk as $key=>$data){
                if($id == $data->id_produk){
                    $produk->forget($key);
                }
            }
        }

        // Data kategori...
        $kategori = Kategori::orderBy('nama_kategori','asc')->limit(5)->get();

        // View...
        return view('produk/user/shop-category', [
            'produk' => $produk,
            'kategori' => $kategori,
            'kategori_produk' => $kategori_produk,
        ]);
    }

    /**
     * Menampilkan data produk dalam "toko" berdasarkan keyword...
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shop_search(Request $request)
    {
        // Data produk sesuai keyword...
        $produk = Produk::where('nama_produk','like','%'.$request->keyword.'%')
            ->orWhere('deskripsi_produk','like','%'.$request->keyword.'%')
            ->orderBy('waktu_update','desc')
            ->paginate(12);

        foreach($produk as $data){
            $data->gambar_produk = explode(',', $data->gambar_produk);
        }

        // Data kategori...
        $kategori = Kategori::orderBy('nama_kategori','asc')->limit(5)->get();

        // View...
        return view('produk/user/shop', [
            'produk' => $produk,
            'kategori' => $kategori,
            'keyword' => $request->keyword,
        ]);
    }

    /**
     * Menampilkan detail produk...
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Data produk berdasarkan $id
        $produk = Produk::find($id);

        // Jika ada produk...
        if($produk){
            $produk->kategori_produk = explode(',', $produk->kategori_produk);
            $produk->gambar_produk = explode(',', $produk->gambar_produk);

            // Kategori produk...
            $kategori = array();
            foreach($produk->kategori_produk as $key=>$value){
                $k = Kategori::find($value);
                array_push($kategori, $k);
            }
        }
        // Jika tidak ada produk...
        else{
            abort(404);
        }

        // View...
        return view('produk/user/detail', [
            'produk' => $produk,
            'kategori' => $kategori,
        ]);  
    }

    /**
     * Mengedit format harga...
     *
     * @param  string  $price
     * @return \Illuminate\Http\Response
     */
    public function generate_price($price)
    {
        // Generate harga...
        $new_price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        $new_price = (double)$new_price;
        $new_price = number_format($new_price,0,',',',');
        echo $new_price;
    }

    /**
     * Mengedit format stok...
     *
     * @param  string  $stock
     * @return \Illuminate\Http\Response
     */
    public function generate_stock($stock)
    {
        // Generate stok...
        $new_stock = filter_var($stock, FILTER_SANITIZE_NUMBER_INT);
        $new_stock = (double)$new_stock;
        $new_stock = number_format($new_stock,0,',',',');
        echo $new_stock;
    }

    /**
     * Menambah stok...
     *
     * @param  string  $stock
     * @return \Illuminate\Http\Response
     */
    public function increase_stock($stock)
    {
        // Menambah stok...
        $new_stock = filter_var($stock, FILTER_SANITIZE_NUMBER_INT);
        $new_stock = (double)$new_stock;
        $new_stock++;
        $new_stock = number_format($new_stock,0,',',',');
        echo $new_stock;
    }

    /**
     * Mengurangi stok...
     *
     * @param  string  $stock
     * @return \Illuminate\Http\Response
     */
    public function decrease_stock($stock)
    {
        // Mengkonversi stok menjadi tipe data double...
        $new_stock = filter_var($stock, FILTER_SANITIZE_NUMBER_INT);
        $new_stock = (double)$new_stock;

        // Mengecek jika stok lebih dari 0...
        if($new_stock > 0){
            // Mengurangi stok...
            $new_stock--;
            $new_stock = number_format($new_stock,0,',',',');
            echo $new_stock;
        }
        // Jika stok sama dengan atau kurang dari 0..
        else{
            $new_stock = 0;
            echo $new_stock;            
        }
    }
}
