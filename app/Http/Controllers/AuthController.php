<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // TODO: Handle request throttle

        if (! Auth::guard()->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        }

        $request->session()->regenerate();

        return to_route('home');
    }

    public function logout(Request $request)
    {
        if (Auth::guard()->check()) {
            Auth::guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        }

        return to_route('login');
    }
}
