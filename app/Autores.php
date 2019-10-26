<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Autores extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['aut_clave', 'aut_nombre', 'aut_apellidos'];
    //protected $hidden = ['name'];

}
