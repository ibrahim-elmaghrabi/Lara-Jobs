<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(){
        return view('Users.register') ;
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required' , 'min:3'] ,
            'email' => ['required' , 'email' ,  Rule::unique('users' , 'email') ] ,
            'password' => ['required' , 'confirmed' , 'min:6'] ,

        ]) ;

            // Hash Password
            $formFields['password'] = bcrypt($formFields['password']) ;
            // create user
            $user = User::create($formFields) ;
            // login
            auth()->login($user) ;

            return redirect('/')->with('message' , 'user created and logged in') ;

    }



    /// thats will remove the user information from the session
    public function logout(Request $request){
        auth()->logout() ;
        $request->session()->invalidate() ;
        $request->session()->regenerateToken() ;

        return redirect('/')->with('message' , 'You have been logged out') ;
    }



    public function login(){
        return view('Users.login') ;
    }



    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required' , 'email' ] ,
            'password' => 'required' ,
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate() ;
            return redirect('/')->with('message' , 'You are now Logged in !') ;
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email') ;
    }



}
