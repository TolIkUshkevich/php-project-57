<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class PageController extends Controller
{
    public function showMainPage()
    {
        return view('main-page');
    }

    public function showLoginPage()
    {
        return view('login-page');
    }

    public function showRegPage()
    {
        return view('reg-page');
    }

    public function showStatusesPage()
    {
        return view('statuses-page');
    }

    public function showStatusCreatePage()
    {
        $statuses = Status::all();
        return view('status-create-page', ['statuses' => $statuses]);
    }
}
