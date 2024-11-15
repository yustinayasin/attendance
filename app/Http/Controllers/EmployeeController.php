<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all employees
        $employees = Employee::all();

        return response()->json([
            'message' => 'List of employees',
            'data' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view for creating a new employee (for web routes)
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
        ]);

        // Create a new employee
        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => $employee,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find an employee by ID
        $employee = Employee::findOrFail($id);

        return response()->json([
            'message' => 'Employee details',
            'data' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Return a view for editing the employee (for web routes)
        $employee = Employee::findOrFail($id);

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
        ]);

        // Update the employee
        $employee->update($validated);

        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Delete the employee
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully',
        ]);
    }
}
