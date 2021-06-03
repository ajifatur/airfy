<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembelian';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pembelian';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'keranjang',
        'id_user',
        'subtotal',
        'ongkir',
        'total',
        'sudah_dibayar',
        'alamat_pengiriman',
        'kota_pengiriman',
        'kode_pos_pengiriman',
        'no_telp_pengiriman',
        'metode_pengiriman',
        'resi_pengiriman',
        'sudah_diterima',
        'tanggal_diterima',
        'waktu_input',
        'waktu_update',
	];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
