<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class EmpleadoDesactivadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $empleadodes = FacadesDB::select('SELECT * FROM empleados WHERE departamento = "División | Cuartos" AND estado = "Baja"');
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
