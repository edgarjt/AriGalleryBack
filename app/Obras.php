<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Obras extends Model
{
    protected $table = 'obras';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['obr_clave', 'obr_clave_autor', 'telefono', 'obr_nombre', 'obr_descripcion', 'obr_precio', 'obr_qr', 'obr_anio', 'obr_ancho', 'obr_alto', 'obr_tecnica', 'obr_estado', 'obr_clave_remodelacion', 'obr_foto'];
    protected $hidden = ['obr_clave'];

}
