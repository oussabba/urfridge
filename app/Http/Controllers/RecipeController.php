<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RecipeRepository;

class RecipeController extends Controller
{
    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository=$recipeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->recipeRepository->getAll();
    }

    public function getRecipe($id){
        return $this->recipeRepository->getRecipeById($id);
    }

    //Get the wanted number of recipes
    public function getLimitedNumberOfRecipes($number){
        $recipes = $this->recipeRepository->getLimitedRecipes($number);
        //Add new item (number loves) to object json (recipe)
        $recipes = json_decode($recipes, TRUE);
        for ($i=0; $i < count($recipes) ; $i++) { 
            $recipes[$i]["number"] = $this->recipeRepository->getNumberLoves($recipes[$i]["id"]);
        }
        $recipes = json_encode($recipes);
        return $recipes;
    }

    //get number of loves
    public function getRecipeLoves($id){
        return $this->recipeRepository->getNumberLoves($id);
    }

    public function getRecipeIngredients($id){
        return $this->recipeRepository->getRecipeIngredientsById($id);
    }

    public function getRecipeKeywords($id){
        return $this->recipeRepository->getRecipeKeywordsById($id);
    }

    public function getRecipeComments($id){
        return $this->recipeRepository->getRecipeCommentsById($id);
    }

    public function sortRecipesByloves($number){
        $recipes = $this->getLimitedNumberOfRecipes($number);
        $recipes = json_decode($recipes, TRUE);
        usort($recipes, function ($a, $b) {
            if($a['number']==$b['number']) return 0;
            return $a['number'] < $b['number']?1:-1;
        });
        $recipes = json_encode($recipes);
        return $recipes;
    }

    public function searchRecipeByTitle(Request $request){
        return $this->recipeRepository->searchForRecipeByTitle($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->recipeRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->recipeRepository->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->recipeRepository->deleteRecipe($id);
    }

    public function getDiets(){
        return $this->recipeRepository->getAllDiets();
    }

    public function getCategories(){
        return $this->recipeRepository->getAllCategories();
    }

    public function getIndredients(Request $request){
        return $this->recipeRepository->getIngredientsByCategorie($request);
    }
}
