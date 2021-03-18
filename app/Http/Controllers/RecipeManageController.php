<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use App\Models\WantedRecipe;
use Illuminate\Http\Request;

class RecipeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.recipes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->request_id){
            return view('dashboard.recipes.create');
        }
        $wanted = WantedRecipe::findOrFail($request->request_id);
        return view('dashboard.recipes.create', [
            'wanted' => $wanted
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRecipeRequest $request)
    {
        if(!auth()->check()){
            abort(403);
        }
        if(isset($request->request_id)){
            $wanted = WantedRecipe::find($request->request_id);
            if(is_null($wanted)){
                abort(400);
            }
            $wanted->delete();
        }
        $validated = array_merge($request->validated(), ['user_id' => auth()->id()]);
        Recipe::create($validated);
        return redirect()->route('dashboard.recipes.index')->with('success', 'Recipe created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        if($recipe->user_id != auth()->id()){
            abort(403);
        }
        return view('dashboard.recipes.edit', [
            'recipe' => $recipe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, $id)
    {
        $recipe = Recipe::find($id);
        if($recipe->user_id != auth()->id() && !auth()->user()->super_user){
            abort(403);
        }
        $recipe->update($request->validated());
        return redirect()->route('dashboard.recipes.index')->with('success', 'Recipe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        if($recipe->user_id != auth()->id() && !auth()->user()->super_user){
            abort(403);
        }
        $recipe->delete();
        return redirect()->route('dashboard.recipes.index')->with('success', 'Recipe deleted successfully');
    }
}
