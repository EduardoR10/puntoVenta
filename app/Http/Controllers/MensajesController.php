<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;

class MensajesController extends Controller
{
    //Mostrar los mensajes
    public function index()
    {
        $mensajes = Mensaje::with('user')->get();
        // Pasar los mensajes a la vista
        //dd($mensajes);
        return view('secret', compact('mensajes'));
    }

    //Guardar un nuevo mensaje encriptado
    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string'
        ]);

        $mensajeEncriptado = encrypt($request->mensaje);

        Mensaje::create([
            'mensaje' => $mensajeEncriptado,
            'id_user' => Auth::id()
        ]);

        return redirect()->route('mensajes.index');
    }
}
