<?php

namespace App\Repositories;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \stdClass;

/**
 * Class RecipeRepository.
 */
class RecipeRepository
{
    protected $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe=$recipe;
    }

    public function store(Request $request){

        $newRecipe=new Recipe();

        $newRecipe->title=$request->recipe["title"];
        $newRecipe->total_time=$request->recipe["total_time"];
        $newRecipe->nmbre_ingredients=$request->recipe["nmbre_ingredients"];
        $newRecipe->description=$request->recipe["description"];
        $newRecipe->process=$request->recipe["process"];
        $newRecipe->image_url=$request->recipe["image_url"];
        $newRecipe->copyrights=$request->recipe["copyrights"];
        $newRecipe->isRoyal=$request->recipe["isRoyal"];

        $newRecipe->save();
        return $newRecipe;
    }

    public function getAll(){
        return Recipe::orderBy('id','DESC')->get();
    }

    public function getRecipeById($id){
        return Recipe::findOrFail($id);
    }

    public function getLimitedRecipes($number){
        return Recipe::orderBy('id','DESC')->take($number)->get();
    }

    public function getNumberLoves($id){
        return DB::table('love_recipe')->where('id_recipe', $id)->count();
    }

    public function getRecipeIngredientsById($id){
        return DB::table('ingredient')
            ->join('recipe_ingredient', 'recipe_ingredient.id_ingredient', '=', 'ingredient.id_ingredient')
            ->select('ingredient.*')
            ->where('recipe_ingredient.id_recipe','=',$id)
            ->get();
    }

    public function getRecipeKeywordsById($id){
        return DB::table('keywords')
            ->join('recipe_keywords', 'recipe_keywords.id_keyword', '=', 'keywords.id_keyword')
            ->select('keywords.*')
            ->where('recipe_keywords.id_recipe','=',$id)
            ->get();
    }

    public function getRecipeCommentsById($id){
        return DB::table('comment')
            ->join('users', 'users.id', '=', 'comment.id_user')
            ->select('comment.text','users.name')
            ->where('comment.id_recipe','=',$id)
            ->get();
    }

    public function searchForRecipeByTitle(Request $request){
        $query=$request->q;
        $diet=$request->diet;
        $pTime=$request->time;
        $searchedRecipes = Recipe::select('*')
                           ->where([
                                ['title', 'LIKE', '%'.$query.'%'],
                                ['total_time','=',$pTime]
                                ])
                           ->get();
        return $searchedRecipes;
    }

    public function getAllDiets(){
        return DB::table('diets')->get();
    }

    public function getAllCategories(){
        return DB::table('ingredient_categorie')->get();
    }

    public function getIngredientsByCategorie(Request $request){
        $categorie=$request->cat;
        return DB::table('ingredient')
            ->join('ingredient_cat', 'ingredient.id_ingredient', '=', 'ingredient_cat.id_ingredient')
            ->select('ingredient.*')
            ->where('ingredient_cat.id_categorie','=',$categorie)
            ->get();
    }

    public function getPaginate($n)
	{
		return $this->recipe->paginate($n);
	}

    public function update(Request $request,$id){
        $existingRecipe= Recipe::find($id);

        if($existingRecipe){ //check if the requested recipe exists
            $existingRecipe->title=$request->recipe["title"];
            $existingRecipe->total_time=$request->recipe["total_time"];
            $existingRecipe->nmbre_ingredients=$request->recipe["nmbre_ingredients"];
            $existingRecipe->description=$request->recipe["description"];
            $existingRecipe->process=$request->recipe["process"];
            $existingRecipe->image_url=$request->recipe["image_url"];
            $existingRecipe->copyrights=$request->recipe["copyrights"];
            $existingRecipe->isRoyal=$request->recipe["isRoyal"];

            $existingRecipe->save();
            return $existingRecipe;
        }
        return "Recipe not found!";
    }

    public function deleteRecipe($id){
        $existingRecipe= Recipe::find($id);

        if($existingRecipe){
            $existingRecipe->delete();
            return "Recipe succefully deleted";
        }

        return "Recipe not found";
    }

    public function getSortedRecipesByDate(){
        return DB::table('recipes')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
            ->orderByDesc('recipes.id')
            ->groupBy('recipes.id')
            ->get();
    }

    public function getSortedRecipesByLoves(){
        return DB::table('recipes')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
            ->orderByDesc('number_loves')
            ->groupBy('recipes.id')
            ->get();
    }

    public function getSortedRecipesByTime(){
        return DB::table('recipes')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
            ->orderBy('recipes.total_time', 'asc')
            ->groupBy('recipes.id')
            ->get();
    }

    public function getSortedRecipesByIngredients(){
        return DB::table('recipes')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
            ->orderBy('recipes.nmbre_ingredients', 'asc')
            ->groupBy('recipes.id')
            ->get();
    }

    public function getRoyalRecipes($request){
        $limit = $request->l;
        return DB::table('recipes')
        ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
        ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
        ->where('isRoyal', 1)
        ->groupBy('recipes.id')
        ->limit($limit)
        ->get();
    }

    public function getRoyalRecipePrice($id){
        return DB::table('royal_recipe_price')->where('id_recipe', $id)->get();
    }

    public function searchRecipes($request){
        $recipes = array();
        $ingredients = $request->i;
        //search for all the recipes that have a least 1 of these ingredients
        $recipesAtLeastOne = DB::table('recipes')
        ->join('recipe_ingredient', 'recipe_ingredient.id_recipe', '=', 'recipes.id')
        ->select('recipes.id')
        ->where('recipe_ingredient.id_ingredient', $ingredients)
        ->get();

        //Check out for each of these recipes if it contains all the wanted ingredients
        foreach ($recipesAtLeastOne as $idRecipe => $idRecipeValue) {
            $counter=0;
            $length = count($ingredients);
            foreach ($ingredients as $key => $ingredientValue) {
                $counter ++;
                $exist = DB::table('recipe_ingredient')
                ->select('recipe_ingredient.id_recipe')
                ->where([
                    ['recipe_ingredient.id_ingredient','=', $ingredientValue],
                    ['recipe_ingredient.id_recipe','=', $idRecipeValue->id]
                        ])
                ->count();
                if($exist==0){
                    break;
                }
                if($counter==$length){
                    $recipe = new stdClass();
                    // $recipe = Recipe::find($idRecipeValue->id);
                    $recipe = DB::table('recipes')
                    ->join('recipe_ingredient', 'recipe_ingredient.id_recipe', '=', 'recipes.id')
                    ->select('recipes.*',DB::raw("COUNT(recipe_ingredient.id_recipe) AS number_ingredients"))
                    ->where('recipe_ingredient.id_recipe','=',$idRecipeValue->id)
                    ->groupBy('recipes.id')
                    ->get()[0];
                    array_push($recipes,$recipe);
                }
            }
        }
        return $recipes;
    }
    public function saveRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        return DB::table('save_recipe')->insert([
            'id_user' => $idUser,
            'id_recipe' => $idRecipe
        ]);
    }

    public function loveRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        return DB::table('love_recipe')->insert([
            'id_user' => $idUser,
            'id_recipe' => $idRecipe
        ]);
    }

    public function unsaveRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        return DB::table('save_recipe')
        ->where([
            ['id_user',$idUser],
            ['idRecipe',$idRecipe]
            ])
        ->delete();
    }

    public function disloveRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        return DB::table('love_recipe')
        ->where([
            ['id_user',$idUser],
            ['idRecipe',$idRecipe]
            ])
        ->delete();
    }

    public function commentRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        $comment = $request->comment;
        return DB::table('comment')->insert([
            'id_user' => $idUser,
            'id_recipe' => $idRecipe,
            'text' => $comment
        ]);
    }

    public function buyRoyalRecipe($request){
        $idUser = $request->user;
        $idRecipe = $request->recipe;
        $comment = $request->comment;
        $userBalance = DB::table('coins_balance')
        ->select('balance')
        ->where('id_user', $idUser)->get();
        $recipePrice = DB::table('royal_recipe_price')
        ->select('price')
        ->where('id_recipe', $idUser)->get();
        if($userBalance >= $recipePrice){
            return DB::table('buy_recipe')->insert([
            'id_user' => $idUser,
            'id_recipe' => $idRecipe,
        ]);
        }else{
            return "Votre balance est insuffisant pour acheter cette recette";
        }
        
    }
}
