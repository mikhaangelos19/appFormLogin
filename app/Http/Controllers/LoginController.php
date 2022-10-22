<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{ 
    public function index(){
        return view('login.index',[
            'title' => 'Login'
        ]);
    }

    public function store(Request $request){
        $request->ensureIsNotRateLimited();

        $request->validate([
            'username' => 'required|min:5|max:20',
            'password' => 'required|min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%]).*$/',
            'CaptchaCode' => 'required|valid_captcha'
        ]);

        $request->authenticate();      
 
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}