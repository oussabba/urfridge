<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
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

Route::get('/recipes',[RecipeController::class,'index']);
Route::prefix('/recipe')->group( Function(){
    Route::post('/store',[RecipeController::class,'store']);
    Route::put('/{id}',[RecipeController::class,'update']);
    Route::delete('/{id}',[RecipeController::class,'destroy']);
});
