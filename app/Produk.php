<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_produk';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'nama_produk',
        'deskripsi_produk',
        'kategori_produk',
        'harga',
        'stok',
        'berat',
        'gambar_produk',
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
