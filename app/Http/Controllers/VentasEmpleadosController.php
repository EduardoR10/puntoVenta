<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class VentasEmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Order::query()
        ->join('employees', 'orders.idemployee', '=', 'employees.id')
        ->selectRaw('CONCAT(employees.name, " ", employees.lastname) as employee_name')
        ->selectRaw('SUM(orders.total) as total_sales')
        ->selectRaw('COUNT(orders.id) as sales_count')
        ->groupBy('employees.id', 'employees.name', 'employees.lastname')
        ->orderBy('total_sales', 'desc');

        if ($month) {
            $query->whereMonth('orders.orderdate', $month);
        }

        if ($year) {
            $query->whereYear('orders.orderdate', $year);
        }

        $reports = $query->paginate(10);

        return view('ventas_empleados.index', compact('reports', 'month', 'year'));
    }



}