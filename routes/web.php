<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\displayController;
use App\Http\Controllers\ItemController;

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
    return redirect('/stock');
});

/*----- Ajouter des nouveaux objet dans la BD -----*/
Route::post('/createItem', [ItemController::class, 'createOrUpdateItem']);

Route::get('/stock', [displayController::class, 'displayStock']);