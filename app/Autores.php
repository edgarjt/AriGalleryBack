<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Autores extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['aut_clave', 'aut_nombre', 'aut_appaterno', 'aut_apmaterno'];
    //protected $hidden = ['name'];

}
