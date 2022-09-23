<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AddOrEditItem;
use App\Http\Controllers\displayController;
use App\Http\Livewire\ViewAll;

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

/*----- Ajouter des nouveaux objet dans la BD -----*/
Route::get('/ajouterObjet', [AddOrEditItem::class, 'render']);
Route::post('/createItem', [ItemController::class, 'createOrUpdateItem']);

Route::get('/', [displayController::class, 'displayStock']);
