<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    protected function actingAsAdminUser(): self
    {
        $admin = User::where('email', 'admin@admin.com')->firstOrFail();

        return $this->actingAs($admin);
    }
}
