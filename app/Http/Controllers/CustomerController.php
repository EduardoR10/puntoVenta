<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Muestra una lista de clientes.
     */
    public function index()
    {
        $customers = Customers::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contactname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
            'razonsocial' => 'required|string|max:255',
            'regimenfiscal' => 'required|string|max:255',
            'rfc' => 'required|string|max:13|unique:customers,rfc',
            'email' => 'required|email|unique:customers,email',
        ]);

        Customers::create($validatedData);

        return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito.');
    }

    /**
     * Muestra los detalles de un cliente.
     */
    public function show(Customers $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     */
    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     */
    public function update(Request $request, Customers $customer)
    {
        $validatedData = $request->validate([
            'contactname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
            'razonsocial' => 'required|string|max:255',
            'regimenfiscal' => 'required|string|max:255',
            'rfc' => 'required|string|max:13|unique:customers,rfc,' . $customer->id,
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update($validatedData);

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito.');
    }

    /**
     * Elimina un cliente de forma lógica.
     */
    public function destroy(Customers $customer)
    {
        $customer->update(['is_active' => false]);
        return redirect()->route('customers.index')->with('success', 'Cliente desactivado con éxito.');
    }
}
