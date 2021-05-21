<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
Route::get('/explore', [PagesController::class, 'explorePage']);
Route::get('/recipes', [PagesController::class, 'recipesPage']);
Route::get('/books', [PagesController::class, 'booksPage']);
Route::get('/signin', [PagesController::class, 'signinPage']);
Route::get('/signup', [PagesController::class, 'signupPage']);
