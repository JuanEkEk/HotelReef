<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $table ='empleados';
    
    protected $primaryKey='id_empleado';

    public $incrementing=true;

    public $timestamps=false;

    protected $fillable=[
    'id_empleado',
    'nombre',
    'foto',
    'une',
    'departamento',
    'puesto',    
    'fecha_alta',
    'estado',

    //datos restantes
    //personales
    'direccion',
    'colonia',
    'codigopostal',
    'telefono',
    'sexo',
    'poblacion',
    'entidaddom',
    'fechanac',
    'nacionalidad',
    'vivecon',
    'estadocivil',
    'lugarnac',
    'ciudadnac',
    'entidadnac',
    'tipocontrato',
    'emailcorp',
    'emailper',

    //documentacion
    'curp',
    'rfc',
    'nss',
    'licmanejo',

    //salud
    'estadosalud',
    'enfermedadcronica',
    'deporte',
    'club',
    'pasatiempo',
    'metavida',

    //datos familiares
    'nompa',
    'vivepa',
    'direccionpa',
    'ocupacionpa',
    'nomma',
    'vivema',
    'direccionma',
    'ocupacionma',
    'nomes',
    'vivees',
    'direcciones',
    'ocupaciones',
    'nomedadhijos',

    //escolaridad
    'estudio',
    'nomescuela',
    'direccionescuela',
    'añoinicial',
    'añofinal',
    'titulo',

    //referencias personales
    'nomrefuno',
    'direccionrefuno',
    'telefonorefuno',
    'ocupacionrefuno',
    'tiempoconoceruno',
    'nomrefdos',
    'direccionrefdos',
    'telefonorefdos',
    'ocupacionrefdos',
    'tiempoconocerdos',

    //horario
    'horario',
    'periodo',
    'diascontrato',

    //sueldo
    'cotizacion',
    'sueldototal',
    'jefedirecto',
    'sueldodiario',
    'formapago',

    //observaciones
    'expediente'
    ];
    
    
}
