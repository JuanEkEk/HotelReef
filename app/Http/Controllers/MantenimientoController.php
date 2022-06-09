<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $mantenimiento = FacadesDB::select('SELECT * FROM empleados WHERE departamento="Mantenimiento" AND estado = "Alta"');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();

        //$empleado->id_empleado=$request->get('id_empleado');
        $empleado->nombre = $request->get('nombre');
        $empleado->une = $request->get('une');
        $empleado->departamento = $request->get('departamento');
        $empleado->puesto = $request->get('puesto');
        $empleado->fecha_alta = $request->get('fecha_alta');
        $empleado->estado = $request->get('estado');


        $empleado->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $empleado = Empleado::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        //$empleado->id_empleado=$request->get('id_empleado');
        $empleado->foto = $request->get('foto');
        $empleado->nombre = $request->get('nombre');
        $empleado->une = $request->get('une');
        $empleado->departamento = $request->get('departamento');
        $empleado->puesto = $request->get('puesto');
        $empleado->fecha_alta = $request->get('fecha_alta');
        $empleado->estado = $request->get('estado');

        //datos restantes
        //personales
        $empleado->direccion = $request->get('direccion');
        $empleado->colonia = $request->get('colonia');
        $empleado->codigopostal = $request->get('codigopostal');
        $empleado->telefono = $request->get('telefono');
        $empleado->sexo = $request->get('sexo');
        $empleado->poblacion = $request->get('poblacion');
        $empleado->entidaddom = $request->get('entidaddom');
        $empleado->fechanac = $request->get('fechanac');
        $empleado->nacionalidad = $request->get('nacionalidad');
        $empleado->vivecon = $request->get('vivecon');
        $empleado->estadocivil = $request->get('estadocivil');
        $empleado->lugarnac = $request->get('lugarnac');
        $empleado->ciudadnac = $request->get('ciudadnac');
        $empleado->entidadnac = $request->get('entidadnac');
        $empleado->tipocontrato = $request->get('tipocontrato');
        $empleado->emailcorp = $request->get('emailcorp');
        $empleado->emailper = $request->get('emailper');

        //documentacion
        $empleado->curp = $request->get('curp');
        $empleado->rfc = $request->get('rfc');
        $empleado->nss = $request->get('nss');
        $empleado->licmanejo = $request->get('licmanejo');

        //salud
        $empleado->estadosalud = $request->get('estadosalud');
        $empleado->enfermedadcronica = $request->get('enfermedadcronica');
        $empleado->deporte = $request->get('deporte');
        $empleado->club = $request->get('club');
        $empleado->pasatiempo = $request->get('pasatiempo');
        $empleado->metavida = $request->get('metavida');

        //datos familiares
        $empleado->nompa = $request->get('nompa');
        $empleado->vivepa = $request->get('vivepa');
        $empleado->direccionpa = $request->get('direccionpa');
        $empleado->ocupacionpa = $request->get('ocupacionpa');
        $empleado->nomma = $request->get('nomma');
        $empleado->vivema = $request->get('vivema');
        $empleado->direccionma = $request->get('direccionma');
        $empleado->ocupacionma = $request->get('ocupacionma');
        $empleado->nomes = $request->get('nomes');
        $empleado->vivees = $request->get('vivees');
        $empleado->direcciones = $request->get('direcciones');
        $empleado->ocupaciones = $request->get('ocupaciones');
        $empleado->nomedadhijos = $request->get('nomedadhijos');

        //escolaridad
        $empleado->estudio = $request->get('estudio');
        $empleado->nomescuela = $request->get('nomescuela');
        $empleado->direccionescuela = $request->get('direccionescuela');
        $empleado->añoinicial = $request->get('añoinicial');
        $empleado->añofinal = $request->get('añofinal');
        $empleado->titulo = $request->get('titulo');

        //referencias personales
        $empleado->nomrefuno = $request->get('nomrefuno');
        $empleado->direccionrefuno = $request->get('direccionrefuno');
        $empleado->telefonorefuno = $request->get('telefonorefuno');
        $empleado->ocupacionrefuno = $request->get('ocupacionrefuno');
        $empleado->tiempoconoceruno = $request->get('tiempoconoceruno');
        $empleado->nomrefdos = $request->get('nomrefdos');
        $empleado->direccionrefdos = $request->get('direccionrefdos');
        $empleado->telefonorefdos = $request->get('telefonorefdos');
        $empleado->ocupacionrefdos = $request->get('ocupacionrefdos');
        $empleado->tiempoconocerdos = $request->get('tiempoconocerdos');

        //horario
        $empleado->horario = $request->get('horario');
        $empleado->periodo = $request->get('periodo');
        $empleado->diascontrato = $request->get('diascontrato');

        //sueldo
        $empleado->cotizacion = $request->get('cotizacion');
        $empleado->sueldototal = $request->get('sueldototal');
        $empleado->jefedirecto = $request->get('jefedirecto');
        $empleado->sueldodiario = $request->get('sueldodiario');
        $empleado->formapago = $request->get('formapago');

        //observaciones
        $empleado->expediente = $request->get('expediente');

        $empleado->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();
    }
}
