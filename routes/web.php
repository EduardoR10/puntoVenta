<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VentasMesController;
use App\Http\Controllers\VentasEmpleadosController;
use App\Http\Controllers\VentasTrimestralesController;
use App\Models\Customer;
use App\Models\Order;

Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::view('/menu', "menu")->name('menu');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/employees', [EmployeeController::class, 'showEmployees'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::get('/products', [ProductController::class, 'showProducts'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/venta', [VentaController::class, 'index'])->name('venta.index');
Route::get('/buscar-producto/{code}', [VentaController::class, 'buscarProducto']);
Route::get('/buscar-producto-nombre/{name}', [VentaController::class, 'buscarProductoNombre']);


Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

Route::post('/pagar', [VentaController::class, 'payOrder']);
Route::get('/obtener-clientes', [VentaController::class, 'obtenerClientes']);

Route::get('/customers', [CustomerController::class, 'showCustomers'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

Route::get('/ventas_mes', [VentasMesController::class, 'index'])->name('ventas_mes.index');

Route::get('/ventas_empleados', [VentasEmpleadosController::class, 'index'])->name('ventas_empleados.index');

Route::get('/ventas_trimestrales', [VentasTrimestralesController::class, 'index'])->name('ventas_trimestrales.index');


