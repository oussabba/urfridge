<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PagesController::class, 'index']);
Route::get('/search', [PagesController::class, 'searchPage']);
Route::get('/search-ingredients', [PagesController::class, 'searchByIngredientsPage']);
Route::get('/explore', [PagesController::class, 'explorePage']);
Route::get('/recipes', [PagesController::class, 'recipesPage']);
Route::get('/books', [PagesController::class, 'booksPage']);
Route::get('/signin', [PagesController::class, 'signinPage']);
Route::get('/signup', [PagesController::class, 'signupPage']);
Route::get('/recipe/{id}/{title}', [PagesController::class, 'recipePage'])->whereNumber('id')->whereAlpha('title');
Route::get('/book/{id}/{title}', [PagesController::class, 'bookPage'])->whereNumber('id')->whereAlpha('title');

//*** TMP****
Route::get('/dashboard/{id}', [PagesController::class, 'dashboardPage'])->whereNumber('id');



