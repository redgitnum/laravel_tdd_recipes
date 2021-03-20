<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RecipeListController;
use App\Http\Controllers\RecipeManageController;
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
Route::view('/', 'home')->name('home');
Route::get('/recipes', [RecipeListController::class, 'index'])->name('recipe.index');
Route::get('/recipes/details/{recipe}', [RecipeListController::class, 'show'])->name('recipe.details');
Route::get('/recipes/search', [RecipeListController::class, 'search'])->name('recipe.search');

Route::get('/recipes/wanted', [RecipeWantedController::class, 'index'])->name('recipe.wanted');
Route::get('/recipes/request', [RecipeWantedController::class, 'create'])->name('recipe.request');
Route::post('/recipes/request', [RecipeWantedController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::prefix('dashboard')->as('dashboard.')->group(function () {
        Route::view('/', 'dashboard.recipes.index');
        Route::resource('recipes', RecipeManageController::class);
    });
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});