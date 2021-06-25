<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class IngredientRepository.
 */
class IngredientRepository
{
    public function getIngredientLabel($id){
        return DB::table('ingredient')
        ->select('name')
        ->where('id_ingredient', $id)
        ->get();
    }
    public function countIngredientsInRecipe($id){
        return DB::table('recipe_ingredient')
        ->where('id_recipe', $id)
        ->count();
    }
}
