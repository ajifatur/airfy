<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rekening';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_rekening';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'bank',
        'nama_rekening',
        'nomor_rekening',
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
