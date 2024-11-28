<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Order::select('id', 'orderdate');

        if ($startDate && $endDate) {
            $query->whereBetween('orderdate', [$startDate, $endDate]);
        }

        $orders = $query->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['employee', 'orderdetails.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}