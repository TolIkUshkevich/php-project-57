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

    public function showRegisterPage()
    {
        return view('reg-page');
    }

    public function showStatusesPage()
    {
        $statuses = Status::all();
        return view('statuses-page', ['statuses' => $statuses]);
    }

    public function showStatusCreatePage()
    {
        return view('status-create-page');
    }

    public function showStatusEditPage(string $id)
    {
        $status = Status::where('status_id', $id)->first();
        return view('status-edit-page', ['status' => $status]);
    }
}
