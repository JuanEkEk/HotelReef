<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
use DB;
use Session;
use Cache;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;

class AccesoController extends Controller
{
    //Validar el acceso al usuario
    public function validar(Request $request)
    {
        $usuario = $request->input('usuario');
        $password = $request->input('password');
        $resultado = FacadesDB::select("SELECT * FROM usuarios WHERE usuario ='$usuario' AND password='$password' ");


        // Verifica que la consulta no esté vacía
        if (!empty($resultado)) {
            $nombre = $resultado[0]->nombre;
            $rol = $resultado[0]->rol;
            $id_usuario = $resultado[0]->id_usuario; //

            FacadesSession::put('usuario', $nombre);
            FacadesSession::put('rol', $rol);
            FacadesSession::put('id_usuario', $id_usuario);
            //Session::put('imagen', $imagen);//

            if ($rol == "Administrador") {
                return redirect('perfil');
            } elseif ($rol = "") {
                return redirect('/');
                // Que direccione a una ruta de empleado
            }
        } else {

            return redirect('/');
        }
    } // Fin de validar

    public function logout()
    {
        FacadesSession::flush();
        FacadesSession::reflash();
        FacadesCache::flush();
        unset($_SESSION);

        return redirect('/');
    }
}
