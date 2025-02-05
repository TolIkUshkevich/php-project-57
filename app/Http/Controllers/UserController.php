<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Validators\UserValidator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = new Validator;
        $email = $request->input("email");
        $password = $request->input("password");
        $user = User::where('email', $email)->first();
        if ($validator->loginValidate($user, $password)) {
            Auth::login($user);
            return redirect('/');
        } else {
            $errorData = $validator->errors();
            return redirect()
                ->route('loginPage')
                ->with('error', $errorData)
                ->with('email', $email);
        }
    }
    
    public function register(Request $request)
    {
        $validator = new UserValidator;
        $name = $request->input("name");
        $email = $request->input("email");
        $passwordConfirmation = $request->input("password_confirmation");
        $password = $request->input("password");
        if ($validator->registrationValidate($password, $passwordConfirmation, $email)) {
            $password = Hash::make($password);
            $user = User::create(["name" => $name, "email" => $email, "password" => $password]);
            Auth::login($user);
            return redirect('/');
        } else {
            $errorData = $validator->errors();
            return redirect()
                ->route('regPage')
                ->with('error', $errorData)
                ->with('name', $name)
                ->with('email', $email);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
