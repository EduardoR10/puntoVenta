<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;

class MensajesController extends Controller{

    public function index(){
        $mensajes = Mensaje::with('user')->get();
        return view('secret', compact('mensajes'));
    }

    public function store(Request $request) {
        $request->validate([
            'mensaje' => 'required|string|max:250'
        ], [
            'mensaje.max' => 'El mensaje no puede tener más de 250 caracteres.',
        ]);
    
        $mensajeEncriptado = encrypt($request->mensaje); //usa el algoritmo AES-256-CBC (Advanced Encryption Standard)
    
        Mensaje::create([
            'mensaje' => $mensajeEncriptado,
            'id_user' => Auth::id()
        ]);
    
        return redirect()->route('mensajes.index');
    }
    
}
