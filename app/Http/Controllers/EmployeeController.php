<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function showEmployees()
    {
        $employees = Employee::active()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    // Almacenar nuevo empleado
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'user' => 'required|string|max:255|unique:employees',
            'password' => 'required|string|min:5',
            'phonenumber' => 'required|string|unique:employees',
            'birthdate' => 'required|date',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'user' => $request->user,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'birthdate' => $request->birthdate,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Actualizar los datos del empleado
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'user' => 'required|string|max:255|unique:employees,user,' . $employee->id,
            'phonenumber' => 'required|string|unique:employees,phonenumber,' . $employee->id,
            'birthdate' => 'required|date',
        ]);

        $employee->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'user' => $request->user,
            'phonenumber' => $request->phonenumber,
            'birthdate' => $request->birthdate,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // Eliminar un empleado
    public function destroy(Employee $employee)
    {
        $employee->update(['is_active' => false]);
        return redirect()->route('employees.index')->with('success', 'Employee disabled successfully!');
    }
}
