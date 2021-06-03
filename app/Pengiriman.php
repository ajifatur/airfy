<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengiriman';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pengiriman';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'pengiriman',
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
