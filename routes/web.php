<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::inertia('/login', 'Auth/LoginPage')->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::inertia('/home', 'HomePage')->name('home');
    Route::inertia('/companies', 'CompaniesPage')->name('company.index');
    Route::inertia('/employees', 'EmployeesPage')->name('employee.index');
});
