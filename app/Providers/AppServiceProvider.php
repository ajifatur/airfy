<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Kontak;
use App\Bantuan;
use App\Pembelian;
use App\Pembayaran;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> bind('path.public', function()
        {
                return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Data kontak...
        $kontak = Kontak::first();

        // Data bantuan...
        $bantuan = Bantuan::all();

        // Set variabel...
        view()->share('var_kontak', $kontak);
        view()->share('var_bantuan', $bantuan);

        View::composer('*', function($view){
            if(Auth::check()){
                if(Auth::user()->role == 1){
                    // Data pembelian belum dibayar...
                    $pembelian_belum_dibayar = Pembelian::where('sudah_dibayar','=',0)->get();
                    view()->share('var_pembelian_belum_dibayar', $pembelian_belum_dibayar->count());

                    // Data pembelian belum diverifikasi...
                    $pembelian_belum_diverifikasi = Pembelian::where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->get();
                    if(count($pembelian_belum_diverifikasi)>0){
                        foreach($pembelian_belum_diverifikasi as $key=>$data){
                            // Data pembayaran...
                            $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();
                            if($pembayaran->sudah_terverifikasi == 1){
                                unset($pembelian_belum_diverifikasi[$key]);
                            }
                        }
                    }
                    view()->share('var_pembelian_belum_diverifikasi', $pembelian_belum_diverifikasi->count());

                    // Data pembelian belum dikirim...
                    $pembelian_belum_dikirim = Pembelian::where('sudah_dibayar','=',1)->where('resi_pengiriman','=','')->where('sudah_diterima','=',0)->get();
                    if(count($pembelian_belum_dikirim)>0){
                        foreach($pembelian_belum_dikirim as $key=>$data){
                            // Data pembayaran...
                            $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();
                            if($pembayaran->sudah_terverifikasi == 0){
                                unset($pembelian_belum_dikirim[$key]);
                            }
                        }
                    }
                    view()->share('var_pembelian_belum_dikirim', $pembelian_belum_dikirim->count());

                    // Data pembelian belum diterima...
                    $pembelian_belum_diterima = Pembelian::join('pengiriman','pembelian.metode_pengiriman','=','pengiriman.id_pengiriman')->where('sudah_dibayar','=',1)->where('resi_pengiriman','!=','')->where('sudah_diterima','=',0)->get();
                    if(count($pembelian_belum_diterima)>0){
                        foreach($pembelian_belum_diterima as $key=>$data){
                            // Data pembayaran...
                            $pembayaran = Pembayaran::where('id_pembelian','=',$data->id_pembelian)->first();
                            if($pembayaran->sudah_terverifikasi == 0){
                                unset($pembelian_belum_diterima[$key]);
                            }
                        }
                    }
                    view()->share('var_pembelian_belum_diterima', $pembelian_belum_diterima->count());

                    // Total pembelian belum tuntas
                    view()->share('var_total_pembelian_belum_tuntas', (
                        $pembelian_belum_dibayar->count() +
                        $pembelian_belum_diverifikasi->count() +
                        $pembelian_belum_dikirim->count() +
                        $pembelian_belum_diterima->count()
                    ));
                }
            }
        });
    }
}
