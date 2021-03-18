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
        $recipes = Recipe::with(['author:id,username'])->latest()->paginate(20, ['id', 'title', 'user_id', 'overview', 'ingredients', 'created_at']);
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
