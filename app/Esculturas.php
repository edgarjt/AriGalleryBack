<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Esculturas extends Model
{
    protected $table = 'esculturas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['esc_clave', 'esc_clave_autor', 'esc_nombre', 'esc_descripcion', 'esc_material', 'esc_precio', 'esc_qr', 'obr_anio', 'obr_ancho', 'esc_alto', 'obr_estado', 'esc_clave_remodelacion', 'esc_foto'];
    //protected $hidden = ['name'];

}
