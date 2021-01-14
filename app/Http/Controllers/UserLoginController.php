<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    //
    public function Login(Request $request) {
        $credentials = $request->only('email', 'password');
        
            if(Auth::attempt($credentials)) {
                $email = $request->input('email');
                $user = User::where('email', $email)->first();
                return response()->json([ 
                    "success" => "success", 
                    "user_id" => $user->id,
                    "user_name" => $user->name,
                    ]);
            }
            else {
                return response()->json([ 
                    "error" => "No se puede autenticar al usuario, por favor revise sus credenciales" 
                    ]);
            }
    }
}