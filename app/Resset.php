<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Resset extends Model
{
    protected $table = 'pass_reset';
    public $timestamps = false;
    //protected $primaryKey = 'usu_id';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'code'];
    //protected $hidden = ['usu_pass'];

}
