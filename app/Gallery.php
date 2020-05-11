<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    protected $table = 'galeriav';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['gal_titulo', 'gal_foto', 'gal_descripcion'];

}
