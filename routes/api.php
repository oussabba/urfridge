<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IngredientController;

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
Route::get('/recipes/all',[RecipeController::class,'getSortedRecipes']);
Route::get('/recipes/{number}',[RecipeController::class,'getLimitedNumberOfRecipes']);
Route::get('/sortedRecipes/{number}',[RecipeController::class,'sortRecipesByloves']);
Route::prefix('/recipe')->group( Function(){
    Route::post('/store',[RecipeController::class,'store']);
    Route::put('/{id}',[RecipeController::class,'update']);
    Route::delete('/{id}',[RecipeController::class,'destroy']);
});
Route::get('/recipe/{id}/loves',[RecipeController::class,'getRecipeLoves']);
//get recipe ingredients
Route::get('/recipe/{id}/ingredients',[RecipeController::class,'getRecipeIngredients']);
Route::get('/recipe/{id}/number-ingredients',[IngredientController::class,'getNumberOfIngredientsInRecipe']);
//get recipe keywords
Route::get('/recipe/{id}/keywords',[RecipeController::class,'getRecipeKeywords']);
//get recipe comments
Route::get('/recipe/{id}/comments',[RecipeController::class,'getRecipeComments']);
//get a recipe by id
Route::get('/recipe/{id}',[RecipeController::class,'getRecipe']);
//Search recipes by ingredients
Route::get('/search/recipes',[RecipeController::class,'searchRecipesByIngredients']);
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
//get royal recipes
Route::get('/royal-recipes',[RecipeController::class,'getRoyalRecipes']);
//get royal recipe price
Route::get('/royal-recipes/{id}/price',[RecipeController::class,'getRoyalRecipePrice']);

//Ingredients
Route::get('/ingredient/{id}/name',[IngredientController::class,'getIngredientLabel']);

//books

Route::get('/books/all',[BookController::class,'index']);
//sorted books by loves
Route::get('/books/sorted/loves',[BookController::class,'sortBooksByloves']);
//get a book by id
Route::get('/book/{id}',[BookController::class,'getBook']);
//get number of loves of a book
Route::get('/book/{id}/loves',[BookController::class,'getBookLoves']);
//get book images
Route::get('/book/{id}/images',[BookController::class,'getBookImages']);
//get book keywords
Route::get('/book/{id}/keywords',[BookController::class,'getBookKeywords']);
//get related books
Route::get('/books',[BookController::class,'getBooksByKeywords']);

//add book proposal
Route::post('/book-proposal',[BookController::class,'addBookProposal']);

//Register a user
Route::post('/register',[UserController::class,'register']);
//login a user
Route::post('/login',[UserController::class,'login']);
//saved recipes by a user
Route::get('/user/{id}/recipes/saved',[UserController::class,'getSavedRecipes']);
//loved recipes by a user
Route::get('/user/{id}/recipes/loved',[UserController::class,'getLovedRecipes']);

//get user [tmp]
// Route::get('/user/{id}',[UserController::class,'getUser']);

//****Protected routes*****
Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('/logout',[UserController::class,'logout']);
    Route::get('/current',[UserController::class,'currentUser']);

    Route::post('/recipe/save',[RecipeController::class,'saveRecipe']);
    Route::post('/recipe/love',[RecipeController::class,'loveRecipe']);
    Route::post('/recipe/unsave',[RecipeController::class,'unsaveRecipe']);
    Route::post('/recipe/dislove',[RecipeController::class,'disloveRecipe']);
    Route::post('/recipe/comment',[RecipeController::class,'commentRecipe']);
    Route::post('/royal-recipe/buy',[RecipeController::class,'buyRoyalRecipe']);
});


