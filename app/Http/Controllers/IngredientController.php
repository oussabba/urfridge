<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IngredientRepository;

class IngredientController extends Controller
{

    protected $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository=$ingredientRepository;
    }
    
    public function getIngredientLabel($id){
        return $this->ingredientRepository->getIngredientLabel($id);
    }

    public function getNumberOfIngredientsInRecipe($id){
        return $this->ingredientRepository->countIngredientsInRecipe($id);
    }
}
