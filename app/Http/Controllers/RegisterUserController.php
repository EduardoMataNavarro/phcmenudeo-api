<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Mail\CorreoRegistro;
use App\Http\Models\User;
use App\Http\Models\InformacionContacto;

class RegisterUserController extends Controller
{
    //
    public function Create(Request $request){
        $Nombre = $request->input('nombre');
        $RFC = $request->input('rfc');
        $Direccion = $request->input('direccion');
        $Telefono = $request->input('telefono');
        $Correo = $request->input('email');
        $Estado = $request->input('estado');
        $Sucursal = $request->input('sucursal');
        $InfoContacto = $request->input('infocontacto');

        $APIResponse = Http::get('https://passwordwolf.com/api/');
        $responseBody = $APIResponse->json();
        $securepassword = $responseBody[0]['password'];
        Log::emergency('Correo del usuario = ' . $Correo);

        $newUser = User::create([
            'Nombre' => $Nombre,
            'RFC' => $RFC,
            'Correo' => $Correo,
            'Password' => Hash::make($securepassword),
            'Estado' => $Estado,
            'Sucursal' => $Sucursal,
        ]);
        $newUser->save();

        $newInfoContacto = InformacionContacto::create([
            'Nombre' => $InfoContacto['nombre'],
            'Puesto' => $InfoContacto['puesto'],
            'Direccion' => $InfoContacto['email'],
            'Telefono' => $InfoContacto['telefono'],
            'TelefonoMovil' => $InfoContacto['telefonoMovil'],
        ]);
        $newInfoContacto->save();
        $newUser->informacioncontacto_id = $newInfoContacto->id;
        $newUser->save();

        Mail::to('test@tester.com')->send(new CorreoRegistro($securepassword));

        return response()->json([ 'message' => 'Revise su correo para poder iniciar sesión con nosotros' ]);        
    }
}
