<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Recipe;
use App\Models\WantedRecipe;
use Illuminate\Http\Request;

class RecipeListController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', [
            'recipes' => $recipes
        ]);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', [
            'recipe' => $recipe
        ]);
    }

    public function search(SearchRequest $request)
    {
        $recipes = Recipe::where('title', 'LIKE', "%{$request->query('query')}%")->get();
        return view('recipes.search', [
            'recipes' => $recipes
        ]);
    }
}
