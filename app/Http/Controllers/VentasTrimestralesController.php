<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class VentasTrimestralesController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year');

        $query = Order::query()
            ->join('ordersdetails', 'id', '=', 'ordersdetails.idorder')
            ->join('products', 'ordersdetails.idproduct', '=', 'products.id')
            ->selectRaw('
                products.name as product_name,
                SUM(CASE WHEN MONTH(orders.orderdate) BETWEEN 1 AND 3 THEN ordersdetails.quantity ELSE 0 END) as q1_sales,
                SUM(CASE WHEN MONTH(orders.orderdate) BETWEEN 4 AND 6 THEN ordersdetails.quantity ELSE 0 END) as q2_sales,
                SUM(CASE WHEN MONTH(orders.orderdate) BETWEEN 7 AND 9 THEN ordersdetails.quantity ELSE 0 END) as q3_sales,
                SUM(CASE WHEN MONTH(orders.orderdate) BETWEEN 10 AND 12 THEN ordersdetails.quantity ELSE 0 END) as q4_sales,
                SUM(ordersdetails.quantity) as total_sales
            ');

        if ($year) {
            $query->whereYear('orders.orderdate', $year);
        }

        $query->groupBy('products.id', 'products.name');

        $query->orderByDesc('total_sales');

        $reports = $query->paginate(10);

        return view('ventas_trimestrales.index', compact('reports', 'year'));
    }


}