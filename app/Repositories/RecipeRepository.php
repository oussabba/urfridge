<?php

namespace App\Repositories;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getLimitedRecipes($number){
        return Recipe::orderBy('id','DESC')->take($number)->get();
    }
    public function getNumberLoves($id){
        return DB::table('love_recipe')->where('id_recipe', $id)->count();
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
}
