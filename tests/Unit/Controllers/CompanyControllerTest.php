<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\CompanyController;
use App\Models\Company;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class CompanyControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_file_exists(): void
    {
        $this->assertTrue(class_exists(CompanyController::class));
    }

    public function test_company_page_requires_login(): void
    {
        $this
            ->get('/companies')
            ->assertRedirect('/login');
    }

    public function test_company_index_page(): void
    {
        $lastCompany = $this->getLastCompany();

        $this
            ->actingAsAdminUser()
            ->get('/companies')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Company/Index')
                ->has('companies', fn (Assert $page) => $page
                    ->has('data', fn (Assert $page) => $page
                        ->has('0', fn (Assert $page) => $page
                            ->where('id', $lastCompany->id)
                            ->where('name', $lastCompany->name)
                            ->where('email', $lastCompany->email)
                            ->etc()
                        )
                        ->etc()
                    )
                    ->etc()
                )
            );
    }

    public function test_company_show_page(): void
    {
        $lastCompany = $this->getLastCompany();

        $this
            ->actingAsAdminUser()
            ->get('/companies/'.$lastCompany->id)
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Company/Show')
                ->has('company', fn (Assert $page) => $page
                    ->where('id', $lastCompany->id)
                    ->etc()
                )
            );
    }

    public function test_company_edit_page(): void
    {
        $lastCompany = $this->getLastCompany();

        $this
            ->actingAsAdminUser()
            ->get(sprintf('/companies/%s/edit', $lastCompany->id))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Company/Edit')
                ->has('company', fn (Assert $page) => $page
                    ->where('id', $lastCompany->id)
                    ->etc()
                )
            );
    }

    public function test_company_create_page(): void
    {
        $this
            ->actingAsAdminUser()
            ->get('/companies/create')
            ->assertOk();
    }

    protected function getLastCompany(): Company
    {
        return Company::latest('id')->first();
    }
}
