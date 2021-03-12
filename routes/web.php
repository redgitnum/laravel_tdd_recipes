<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeListController;
use App\Http\Controllers\RecipeWantedController;

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
Route::get('/', [RecipeListController::class, 'index']);
Route::get('/recipes/details/{recipe}', [RecipeListController::class, 'show']);
Route::get('/recipes/search', [RecipeListController::class, 'search']);

Route::get('/recipes/wanted', [RecipeWantedController::class, 'index']);
Route::get('/recipes/request', [RecipeWantedController::class, 'create']);
Route::post('/recipes/request', [RecipeWantedController::class, 'store']);
