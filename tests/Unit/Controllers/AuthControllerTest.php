<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\AuthController;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_file_exists(): void
    {
        $this->assertTrue(class_exists(AuthController::class));
    }

    public function test_login_request_validation_failed(): void
    {
        $this
            ->from('/login')
            ->post('/login')
            ->assertRedirect('/login')
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'password' => 'The password field is required.',
            ]);

        $this
            ->from('/login')
            ->post('/login', [
                'email' => 'asdasd asdasd',
                'password' => '123',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors([
                'email' => 'The email field must be a valid email address.',
                'password' => 'The password field must be at least 8 characters.',
            ]);
    }

    public function test_login_incorrect_credentials(): void
    {
        $this->seed();

        $this
            ->from('/login')
            ->post('/login', [
                'email' => 'random@mail.com',
                'password' => '12345678',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    public function test_login_success(): void
    {
        $this->seed();

        $this
            ->post('/login', [
                'email' => 'admin@admin.com',
                'password' => 'password',
            ])
            ->assertRedirectToRoute('home');
    }
}
