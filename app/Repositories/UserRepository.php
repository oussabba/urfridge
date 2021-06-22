<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;


/**
 * Class UserRepository.
 */
class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    public function getUserById($id){
        return DB::table('users')
            ->join('coins_balance', 'coins_balance.id_user', '=', 'users.id')
            ->select('users.*','coins_balance.balance')
            ->where('users.id','=',$id)
            ->get();
    }

    public function getSavedRecipes($id){
        return DB::table('recipes')
            ->join('save_recipe', 'save_recipe.id_recipe', '=', 'recipes.id')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*',DB::raw("COUNT(love_recipe.id_recipe) AS number_loves"))
            ->where('save_recipe.id_user','=',$id)
            ->groupBy('recipes.id')
            ->get();
    }

    public function getLovedRecipes($id){
        return DB::table('recipes')
            ->join('love_recipe', 'love_recipe.id_recipe', '=', 'recipes.id')
            ->select('recipes.*')
            ->where('love_recipe.id_user','=',$id)
            ->get();
    }
}
