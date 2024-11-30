<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class VentasMesController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Order::query();

        if ($month) {
            $query->whereMonth('orderdate', $month);
        }

        if ($year) {
            $query->whereYear('orderdate', $year);
        }

        $orders = $query->paginate(10);

        return view('ventas_mes.index', compact('orders', 'month', 'year'));
    }



}