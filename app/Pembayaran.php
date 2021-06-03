<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pembayaran';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'id_pembelian',
		'nama_rekening',
		'jumlah_pembayaran',
		'tanggal_pembayaran',
		'bukti_pembayaran',
		'sudah_terverifikasi',
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
