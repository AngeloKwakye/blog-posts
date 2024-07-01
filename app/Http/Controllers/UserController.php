<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    //controller for user registration
    public function register(Request $request){
        //validating user data from registration form
        $incomingData = $request->validate([
            //Rule::unique => function is used to check for a unique {name} in the users table;
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
             //Rule::unique => function is used to check for a unique {email} in the users table;
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:100']
        ]);
        //using the bcrypt library to encrypt password before saving to database
        $incomingData['password'] = bcrypt($incomingData['password']);
        //using the User model to create a new user with the create() function
        $user = User::create($incomingData);
        //login user to create a session;
        auth()->login($user);
        return redirect('/');
    }

    //controller for logging out
    public function logout(){
        //log user out to end user session
        auth()->logout();
        return redirect('/');
    }

    //controller to login user
    public function login(Request $request){
        //validating form data from form;
        $incomingData = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
        //checking for correct data and granting user session. 
        if(auth()->attempt(['name'=> $incomingData['loginname'], 'password'=> $incomingData['loginpassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }
}
