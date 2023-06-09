<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class EmployeeControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_file_exists(): void
    {
        $this->assertTrue(class_exists(EmployeeController::class));
    }

    public function test_employee_page_requires_login(): void
    {
        $this
            ->get('/employees')
            ->assertRedirect('/login');
    }

    public function test_employee_index_page(): void
    {
        $lastEmployee = $this->getLastEmployee();

        $this
            ->actingAsAdminUser()
            ->get('/employees')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Employee/Index')
                ->has('employees', fn (Assert $page) => $page
                    ->has('data', fn (Assert $page) => $page
                        ->has('0', fn (Assert $page) => $page
                            ->where('id', $lastEmployee->id)
                            ->where('first_name', $lastEmployee->first_name)
                            ->where('last_name', $lastEmployee->last_name)
                            ->where('company_id', $lastEmployee->company_id)
                            ->where('email', $lastEmployee->email)
                            ->where('phone', $lastEmployee->phone)
                            ->etc()
                        )
                        ->etc()
                    )
                    ->etc()
                )
            );
    }

    public function test_employee_show_page(): void
    {
        $lastEmployee = $this->getLastEmployee();

        $this
            ->actingAsAdminUser()
            ->get('/employees/'.$lastEmployee->id)
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Employee/Show')
                ->has('employee', fn (Assert $page) => $page
                    ->where('id', $lastEmployee->id)
                    ->etc()
                )
            );
    }

    public function test_employee_edit_page(): void
    {
        $lastEmployee = $this->getLastEmployee();

        $this
            ->actingAsAdminUser()
            ->get(sprintf('/employees/%s/edit', $lastEmployee->id))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Employee/Edit')
                ->has('employee', fn (Assert $page) => $page
                    ->where('id', $lastEmployee->id)
                    ->etc()
                )
                ->has('companies', 30)
            );
    }

    public function test_employee_create_page(): void
    {
        $this
            ->actingAsAdminUser()
            ->get('/employees/create')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->has('companies', 30)
            );
    }

    protected function getLastEmployee(): Employee
    {
        return Employee::latest('id')->first();
    }
}
