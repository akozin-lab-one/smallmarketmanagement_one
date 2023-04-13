<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login page
    public function loginPage(){
            return view('login');
    }

    //register page
    public function registerPage(){
        return view('register');
    }

    public function dashboard(){
        if (Auth::user()->role == 'superuser') {
            return redirect()->route('Super#dashboard');
        }else{
            return redirect()->route('adminuser#main');
        }
    }
}
