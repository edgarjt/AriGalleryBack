<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['pro_titulo', 'pro_descripcion', 'pro_foto', 'pro_precio'];

}
