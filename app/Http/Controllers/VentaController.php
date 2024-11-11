<?php

namespace App\Http\Controllers;

use App\Models\Product; // Modelo Product
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function index()
    {
        $employeeName = auth::user()->name ?? '';
        return view('venta.index', compact('employeeName'));
    }

    public function buscarProducto($code)
    {
        $product = Product::where('code', $code)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado.'
            ]);
        }
    }
}
