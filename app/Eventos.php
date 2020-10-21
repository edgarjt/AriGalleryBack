<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Eventos extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['eve_tipo', 'eve_nombre', 'eve_descripcion', 'eve_fecha', 'eve_horario'];
    //protected $hidden = ['name'];

}
