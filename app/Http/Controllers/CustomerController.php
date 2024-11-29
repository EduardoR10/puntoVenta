<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function showCustomers()
    {
        $customers = Customer::active()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contactname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
            'razonsocial' => 'required|string|max:255',
            'regimenfiscal' => 'required|string|max:100',
            'rfc' => 'required|string|max:50|unique:customers',
            'email' => 'required|string|email|max:100|unique:customers',
            'is_active' => 'required|boolean',
        ]);

        //Llamar al procedimiento almacenado para insertar un cliente
        DB::statement('CALL InsertCustomer(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $validated['contactname'],
            $validated['address'],
            $validated['city'],
            $validated['country'],
            $validated['phonenumber'],
            $validated['razonsocial'],
            $validated['regimenfiscal'],
            $validated['rfc'],
            $validated['email'],
            $validated['is_active'],
        ]);

        return redirect()->route('customers.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'contactname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
            'razonsocial' => 'required|string|max:255',
            'regimenfiscal' => 'required|string|max:100',
            'rfc' => 'required|string|max:50',
            'email' => 'required|string|email|max:100',
            'is_active' => 'required|boolean',
        ]);

        // Llamar al procedimiento almacenado para actualizar un cliente
        DB::statement('CALL UpdateCustomer(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $validated['contactname'],
            $validated['address'],
            $validated['city'],
            $validated['country'],
            $validated['phonenumber'],
            $validated['razonsocial'],
            $validated['regimenfiscal'],
            $validated['rfc'],
            $validated['email'],
            $validated['is_active'],
        ]);

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado exitosamente.');
    }


    public function destroy(Customer $customer)
    {
        //Llamamos al procedimiento almacenado para desactivar el cliente
        DB::statement('CALL DeleteCustomer(?)', [$customer->id]);
    
        return redirect()->route('customers.index')->with('success', 'Cliente desactivado con éxito.');
    }
    

    public function orders()
    {
        return $this->hasMany(Order::class, 'idcustomer', 'id');
    }
}
