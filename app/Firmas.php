<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Firmas extends Model
{
    protected $table = 'firmas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['fir_clave', 'fir_nombre_autor', 'fir_lugar_nacimiento', 'fir_foto', 'obr_precio', 'obr_qr', 'obr_anio', 'obr_ancho', 'obr_alto', 'obr_tecnica', 'obr_estado', 'obr_clave_remodelacion', 'obr_foto'];
    //protected $hidden = ['name'];

}
