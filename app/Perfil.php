<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
    	'nombre',
    	'usuario',
    	'password'
    ];
}
