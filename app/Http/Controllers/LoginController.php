<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'user' => 'required|unique:employees,user',
            'password' => [
                'required',
                'string',
                'min:6', //al menos 6 caracteres
                'regex:/[A-Z]/', //una mayuscula
                'regex:/[0-9]/', //un numero
            ],
            'phonenumber' => 'required|unique:employees,phonenumber',
            'birthdate' => 'required|date',
        ], [
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula y un número.',
            'user.unique' => 'Este usuario ya está registrado.',
        ]);

        $employee = new Employee();
        $employee->name = $validatedData['name'];
        $employee->user = $validatedData['user'];
        $employee->lastname = $validatedData['lastname'];
        $employee->phonenumber = $validatedData['phonenumber'];
        $employee->birthdate = $validatedData['birthdate'];
        $employee->password = Hash::make($validatedData['password']);
        $employee->save();

        Auth::login($employee);
        return redirect()->route('login');
    }



    public function login(Request $request)
    {
        $credentials = [
            "user" => $request->user,
            "password" => $request->password,
        ];

        $remember = $request->has('remember');
        $employee = Employee::where('user', $credentials['user'])->where('is_active', true)->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            Auth::login($employee, $remember);
            
            // Guardamos el nombre y el ID del empleado en la sesión
            $request->session()->put('employee_name', $employee->name . ' ' . $employee->lastname);
            $request->session()->put('employee_id', $employee->id);  // Guardamos el ID del empleado
            $request->session()->regenerate();

            return redirect()->route('menu', ['employee_name' => $employee->name]);        
        } else {
            return redirect()->route('login')->withErrors([
                'user' => 'Las credenciales no coinciden o el usuario está inactivo.',
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
