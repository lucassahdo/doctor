<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller {

    function __construct($Cache = null) {
        //...
    }

    public function index() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.login');
    }
    
    public function in(Request $req) {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];
        $status = Auth::attempt($credentials);
        if ($status)
            return redirect()->route('dashboard');
        
        return redirect()->route('login');
    }

    public function out() {
        Auth::logout();
        return redirect()->route('login');
    }
}
