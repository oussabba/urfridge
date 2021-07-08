<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }

    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string|max:255|unique:users|alpha_dash',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('userToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

     public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user) {
            return response([
                'message' => 'Wrong email!'
            ], 401);
        }
        if(!Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Wrong password!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }

    public function currentUser(){
        return Auth::User();
    }

    public function getUser($id){
        return $this->userRepository->getUserById($id);
    }

    public function getSavedRecipes($id){
        return $this->userRepository->getSavedRecipes($id);
    }

    public function getLovedRecipes($id){
        return $this->userRepository->getLovedRecipes($id);
    }
    
}
