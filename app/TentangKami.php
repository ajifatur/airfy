<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tentang_kami';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_tentang_kami';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
        'konten_tentang_kami',
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
