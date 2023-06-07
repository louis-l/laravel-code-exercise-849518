<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        return Inertia::render('Company/Index', [
            'companies' => Company::query()
                ->withCount('employees')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreCompanyRequest $request)
    {
        //
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        //
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }
}
