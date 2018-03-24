<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct(){

        $this->middleware('guest')->except(['destroy','store']);
    }
    // (get)login
    public function create(){

        return view('sessions.create');
    }
    // (post)Login
    public function store(){

      if(!auth()->attempt(request(['email','password']))){

          return back()->withErrors([
                'message' => 'Svp vérifiez votre courriel et mot de passe et essayer de nouveau.'
          ]);
      }
      return redirect()->home();
    }
    // Logout
    public function destroy(){ 

        auth()->logout();

        return redirect()->home();
        
    }
}
