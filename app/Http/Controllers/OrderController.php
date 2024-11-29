<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Order::query();

        if ($start_date) {
            $query->whereDate('orderdate', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('orderdate', '<=', $end_date);
        }

        $orders = $query->paginate(10);

        return view('orders.index', compact('orders', 'start_date', 'end_date'));
    }


    public function show($id)
    {
        $order = Order::with(['employee', 'customer', 'orderDetails.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function ventasmes(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Order::query();

        if ($month && $year) {
            $query->whereYear('orderdate', $year)->whereMonth('orderdate', $month);
        }

        $orders = $query->get();

        return view('ventas_mes.index', compact('orders'));
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idcustomer', 'id');
    }
}