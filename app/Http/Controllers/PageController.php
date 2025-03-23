<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PageController extends Controller
{
    public function showMainPage()
    {
        return view('main-page');
    }

    public function showStatusesPage()
    {
        $statuses = Status::orderBy('id')->get();
        return view('statuses-page', ['statuses' => $statuses]);
    }

    public function showStatusCreatePage()
    {
        return view('status-create-page');
    }

    public function showStatusUpdatePage(Status $status)
    {
        return view('status-update-page', ['status' => $status]);
    }

    public function showLabelsPage()
    {
        $labels = Label::orderBy('id')->get();
        return view('labels-page', ['labels' => $labels]);
    }

    public function showLabelsCreatePage()
    {
        return view('label-create-page');
    }

    public function showLabelUpdatePage(string $id)
    {
        $label = Label::find($id);
        return view('label-update-page', ['label' => $label]);
    }
}
