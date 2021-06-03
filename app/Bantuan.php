<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bantuan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_bantuan';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'judul_bantuan',
        'permalink_bantuan',
        'konten_bantuan',
        'author',
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
