<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function searchPage()
    {
        return view('search');
    }

    public function explorePage()
    {
        return view('explore');
    }

    public function recipesPage()
    {
        return view('recipes');
    }

    public function booksPage()
    {
        return view('books');
    }

    public function signinPage()
    {
        return view('signin');
    }

    public function signupPage()
    {
        return view('signup');
    }

    public function recipePage(){
        return view('recipe');
    }

    public function bookPage(){
        return view('book');
    }
}
