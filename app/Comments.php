<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comments extends Model
{
    protected $table = 'comentarios';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['com_clave', 'com_comentario', 'com_fk_usuario'];

}
