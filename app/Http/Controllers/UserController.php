<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InformacionContacto;

class UserController extends Controller
{
    //
    public function Index(){
        $users = User::all();
        return response()->json($users);
    }

    public function GetById($id) {
        $user = User::find($id)->with('InformacionContacto')->where('id', $id)->first();
        return response()->json($user);
    }

    public function Edit(Request $request) {
        $idusuario = $request->input('idusuario');
        $nombre = $request->input('nombre');
        $rfc = $request->input('rfc');
        $correo = $request->input('correo');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $rol = $request->input('rolid');
        $estado = $request->input('estadoid');
        $sucursal = $request->input('sucursalid');
        $infoContacto = $request->input('infoContacto');

        $usuario = Usuario::find($idusuario);
        if ($usuario) {
            $usuario->Nombre = $nombre;
            $usuario->RFC = $rfc;
            $usuario->Correo = $correo;
            $usuario->Direccion = $direccion;
            $usuario->Telefono = $telefono;
            $usuario->rol_id = $rol;
            $usuario->estado_id = $estado;
            $usuario->sucursal_id = $sucursal;
            $usuario->save();

            $infocontactoid = $infoContacto['id'];
            $informacionContacto = InformacionContacto::find($infoContactoid);
            if ($informacionContacto) {
                $informacionContacto->Nombre = $infoContacto['nombre'];
                $informacionContacto->Puesto = $infoContacto['puesto'];
                $informacionContacto->Direccion = $infoContacto['direccion'];
                $informacionContacto->Email = $infoContacto['email'];
                $informacionContacto->Telefono = $infoContacto['telefono'];
                $informacionContacto->TelefonoMovil = $infoContacto['telefonoMovil'];
                $informacionContacto->save();

                return response()->json($usuario->with('InformacionContacto')->where('id', $usuario->id)->first());
            }
            else {
                $newInfoContacto = InformacionContacto::create([
                    'Nombre' => $infoContacto['nombre'],
                    'Puesto' => $infoContacto['puesto'],
                    'Direccion' => $infoContacto['direccion'],
                    'Email' => $infoContacto['email'],
                    'Telefono' => $infoContacto['telefono'],
                    'TelefonoMovil' => $infoContacto['telefonoMovil'],
                    'user_id' => $usuario->id,
                ]);
                $newInfoContacto->save();

                return response()->json($usuario->with('InformacionContacto')->where('id', $usuario->id)->first());
            }
        }
        else {
            return response()->json(['message' => 'Usuario no encontrado']);
        }
    }
}
