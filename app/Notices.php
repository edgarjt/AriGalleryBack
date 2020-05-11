<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Notices extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['not_clave', 'not_nombre', 'not_descripcion'];
    //protected $hidden = ['name'];

}
