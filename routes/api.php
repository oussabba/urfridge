<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\BannerController;

use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//recipes
Route::get('/recipes',[RecipeController::class,'index']);
Route::get('/recipes/{number}',[RecipeController::class,'getLimitedNumberOfRecipes']);
Route::get('/sortedRecipes/{number}',[RecipeController::class,'sortRecipesByloves']);
Route::prefix('/recipe')->group( Function(){
    Route::post('/store',[RecipeController::class,'store']);
    Route::put('/{id}',[RecipeController::class,'update']);
    Route::delete('/{id}',[RecipeController::class,'destroy']);
});
//Carousel banner
Route::get('/banner',[BannerController::class,'index']);

