<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Autores extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['aut_clave', 'aut_nombre', 'aut_apellidos', 'aut_foto', 'aut_templanza'];
    //protected $hidden = ['name'];

}
