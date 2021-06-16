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
//get a recipe by id
Route::get('/recipe/{id}',[RecipeController::class,'getRecipe']);
//search for a recipe
Route::get('/searchRecipes',[RecipeController::class,'searchRecipeByTitle']);
//Carousel banner
Route::get('/banner',[BannerController::class,'index']);
//get all diets
Route::get('/diets',[RecipeController::class,'getDiets']);
//get all ingradients categories
Route::get('/ing-categories',[RecipeController::class,'getCategories']);
//get ingredients by categorie
Route::get('/ingredients',[RecipeController::class,'getIndredients']);



