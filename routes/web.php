<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('login', [LoginController::class, 'displayLogin'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class);
    Route::get('/stock', [DisplayController::class, 'displayStock'])->name('stock');
    Route::get('/history', History::class);
});
