<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $employeeName = $request->session()->get('employee_name', ''); 
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

    public function payOrder(Request $request)
    {
        DB::beginTransaction(); // Iniciar la transacción
    
        try {
            // Verificar los datos recibidos
            \Log::info('Datos de la orden:', $request->all());
    
            $orderData = $request->all();
    
            // Lógica para procesar la orden
            $order = Order::create([
                'idemployee' => $orderData['employeeId'],
                'subtotal' => $orderData['subtotal'],
                'iva' => $orderData['iva'],
                'total' => $orderData['total'],
                'orderdate' => now()
            ]);
    
            // Insertar los detalles de la orden
            foreach ($orderData['products'] as $product) {
                OrderDetail::create([
                    'idorder' => $order->id,
                    'idproduct' => $product['productId'],
                    'quantity' => $product['quantity'],
                    'unitprice' => $product['unitPrice']
                ]);
            }
    
            DB::commit(); // Confirmar la transacción si todo es exitoso
    
            // Respuesta exitosa
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir la transacción en caso de error
    
            // Loguear el error
            \Log::error('Error al procesar la orden:', ['error' => $e->getMessage()]);
    
            // Respuesta de error
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
