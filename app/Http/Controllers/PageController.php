<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showMainPage()
    {
        $logged = Auth::check();
        return view('main-page', ['logged' => $logged]);
    }

    public function showLoginPage()
    {
        return view('login-page');
    }

    public function showRegPage()
    {
        return view("reg-page");
    }
}
