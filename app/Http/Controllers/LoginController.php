<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6', //al menos 6 caracteres
                'regex:/[A-Z]/', //una mayuscula
                'regex:/[0-9]/', //un numero
            ],
        ], [
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula y un número.',
            'email.unique' => 'Este correo ya está registrado.',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        Auth::login($user);
        return redirect()->route('login');
    }



    public function login(Request $request){

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials,$remember)){

            $request->session()->regenerate();

            return redirect()->route('mensajes.index');

        }else{
            return redirect()->route('login')->withErrors([
                'email' => 'Las credenciales no coinciden.',
            ]);
        }
        
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));

    }

   

}
