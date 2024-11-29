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
    
    public function obtenerClientes()
    {
        try {
            $clientes = DB::table('customers')
                ->where('is_active', 1)
                ->select('id', 'contactname', 'razonsocial')
                ->get();

            return response()->json(['success' => true, 'clientes' => $clientes]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al obtener los clientes: ' . $e->getMessage()], 500);
        }
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
        DB::beginTransaction();

        try {
            // Verificar los datos recibidos
            \Log::info('Datos de la orden:', $request->all());
            $orderData = $request->all();

            // Validar que se envíe el id del cliente
            if (!isset($orderData['idcustomer'])) {
                throw new \Exception('No se ha seleccionado un cliente para la orden.');
            }

            // Crear la orden
            $order = Order::create([
                'idemployee' => $orderData['employeeId'],
                'idcustomer' => $orderData['idcustomer'],
                'subtotal' => $orderData['subtotal'],
                'iva' => $orderData['iva'],
                'total' => $orderData['total'],
                'orderdate' => now()
            ]);

            // Insertar los detalles de la orden y actualizar el stock de cada producto
            foreach ($orderData['products'] as $product) {
                OrderDetail::create([
                    'idorder' => $order->id,
                    'idproduct' => $product['productId'],
                    'quantity' => $product['quantity'],
                    'unitprice' => $product['unitPrice']
                ]);

                $productModel = Product::find($product['productId']);
                if ($productModel) {
                    if ($productModel->stock < $product['quantity']) {
                        throw new \Exception("Stock insuficiente para el producto ID: {$product['productId']}");
                    }

                    $productModel->stock -= $product['quantity'];
                    $productModel->save();
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al procesar la orden:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function buscarProductoNombre($name)
    {
        try {
            $product = Product::where('name', 'like', '%' . $name . '%')->first();

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
        } catch (\Exception $e) {
            // Captura cualquier error y devuelve un mensaje detallado
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar el producto: ' . $e->getMessage()
            ], 500); // Código de estado 500 para error interno del servidor
        }
    }

}
