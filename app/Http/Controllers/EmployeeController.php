<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        return Inertia::render('Employee/Index', [
            'employees' => Employee::query()
                ->with('company')
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Employee/Create', [
            'companies' => Company::query()->get(),
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());

        return to_route('employees.index');
    }

    public function show(Employee $employee)
    {
        return Inertia::render('Employee/Show', [
            'employee' => $employee,
        ]);
    }

    public function edit(Employee $employee)
    {
        return Inertia::render('Employee/Edit', [
            'employee' => $employee,
            'companies' => Company::query()->get(),
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee
            ->fill($request->validated())
            ->save();

        return to_route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return to_route('employees.index');
    }
}
