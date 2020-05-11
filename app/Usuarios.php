<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usuarios extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;
    //protected $primaryKey = 'usu_id';
    protected $fillable = ['usu_id','usu_clave', 'usu_telefono', 'usu_email', 'usu_nombre', 'usu_appaterno', 'usu_apmaterno', 'usu_tipo', 'usu_pass' ];
    protected $hidden = ['usu_pass'];

}
