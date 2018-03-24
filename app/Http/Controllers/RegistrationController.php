<?php

namespace App\Http\Controllers;
use App\User;
use App\Mail\WelcomeAgain;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    // get register
    public function create()
    {
        return view('registration.create');
    
    }
    // post register
    public function store(){

        $this->validate(request(), [
            'name'=> 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
       $user= User::create([
           'name'=> request('name'),
           'email' => request('email'),
           'password' => bcrypt(request('password'))
       ]);

        auth()->login($user);

        \Mail::to($user)->send(new WelcomeAgain($user));
        
        return redirect()->home();
    }
}
