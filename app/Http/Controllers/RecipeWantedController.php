<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWantedRequest;
use App\Models\WantedRecipe;
use Illuminate\Http\Request;

class RecipeWantedController extends Controller
{
    public function index()
    {
        $recipes = WantedRecipe::with(['author:id,username'])->latest()->paginate(20);
        return view('recipes.wanted.index', [
            'recipes' => $recipes
        ]);
    }

    public function create()
    {
        return view('recipes.wanted.create');
    }

    public function store(CreateWantedRequest $request)
    {
        WantedRecipe::create($request->validated());
    }

}
