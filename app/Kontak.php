<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kontak';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_kontak';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'nama_perusahaan',
        'logo_perusahaan',
        'alamat',
        'email',
        'no_telepon',
        'kota_pengiriman',
	];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
