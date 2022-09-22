<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AddOrEditItem;

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
    return view('welcome');
});

/*----- Ajouter des nouveaux objet dans la BD -----*/
Route::get('/ajouterObjet', [AddOrEditItem::class, 'render']);
Route::post('/createItem', [ItemController::class, 'createOrUpdateItem']);