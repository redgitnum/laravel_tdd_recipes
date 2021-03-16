<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        if(!User::create($validated)){
            return redirect()->route('register')->with('failure', 'Something went wrong');
        }
        if(!Auth::attempt($request->validated())){
            return redirect()->route('login')->with('failure', 'Invalid credentials');
        }
        return redirect()->route('recipes.index');
    }
}
