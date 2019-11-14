<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = ['name' => $request->name, 'password' => $request->password];
        if (Auth::attempt($credenciais)) {
            return redirect()->route('home');
        } 

        return redirect()->back()->withInput()->withErrors(['Os dados informados estão incorretos!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
