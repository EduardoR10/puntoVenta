<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Mostrar historial de ventas
    public function index()
    {
        $orders = Order::select('id', 'orderdate')->get();
        return view('orders.index', compact('orders'));
    }

    // Mostrar detalle de la orden (Ticket)
    public function show($id)
    {
        $order = Order::with(['employee', 'orderdetails.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
