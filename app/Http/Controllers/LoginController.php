<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function Login(Request $request) {
        $credentials = $request->only('email', 'password');
        
            if(Auth::attempt($credentials)) {
                $email = $request->input('email');
                $user = User::where('Correo', $email)->get();
                return response()->json([ 
                    "message" => "success", 
                    "user_id" => $user->id,
                    "user_name" => $user->Nombre,
                    ]);
            }
            else {
                return response()->json([ 
                    "message" => "No se puede autenticar al usuario, por favor revise sus credenciales" 
                    ]);
            }
    }
}