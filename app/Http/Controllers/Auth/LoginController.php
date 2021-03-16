<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated())){
            return redirect()->route('login')->with('failure', 'Invalid credentials');
        }
        return redirect()->route('recipes.index');
    }
}
