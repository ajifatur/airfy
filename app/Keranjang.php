<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'keranjang';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_keranjang';

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
        'sudah_dibeli',
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
