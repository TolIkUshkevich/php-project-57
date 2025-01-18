<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main() {
        return view('main-page');
    }

    public function login() {
        return view('login-page');
    }
}
