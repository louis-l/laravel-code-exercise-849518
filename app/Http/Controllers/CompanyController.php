<?php

namespace App\Http\Controllers;

use App\Actions\StoreCompanyLogo;
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
                ->latest('id')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Company/Create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $companyData = $request
            ->safe()
            ->merge([
                'logo' => resolve(StoreCompanyLogo::class)->execute($request->file('logo')),
            ]);

        Company::create($companyData->toArray());

        return to_route('companies.index');
    }

    public function show(Company $company)
    {
        return Inertia::render('Company/Show', [
            'company' => $company,
        ]);
    }

    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', [
            'company' => $company,
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $companyData = $request
            ->safe()
            ->merge([
                'logo' => resolve(StoreCompanyLogo::class)->execute($request->file('logo')),
            ]);

        // The "logo_previous" allows users to update other fields but not logo.
        if (empty($companyData['logo']) && $companyData['logo_previous']) {
            $companyData['logo'] = $companyData['logo_previous'];
        }

        $company
            ->fill($companyData->except('logo_previous'))
            ->save();

        return to_route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return to_route('companies.index');
    }
}
