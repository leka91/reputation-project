<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'landingPage'])->name('landingPage');
Route::get('/dashboard/{id}', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'dashboardPost'])->name('dashboardPost');
Route::get('/dashboard/{id}/location/{locationId}', [DashboardController::class, 'dashboardLocation'])->name('dashboardLocation');
