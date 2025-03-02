<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;

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

    public function showTasksPage(Request $request)
    {
        $page = $request->page ?? 1;
        $tasks = Task::orderBy('id')->get();
        return view('tasks-page', ['tasks' => $tasks, 'page' => $page]);
    }

    public function showTaskPage(Request $request, string $id)
    {
        $task = Task::find($id);
        return view('task-page', ['task' => $task]);
    }

    public function showTaskCreatePage()
    {
        $statuses = Status::orderBy('id')->get();
        $labels = Label::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('task-create-page', ['labels' => $labels, 'statuses' => $statuses, 'users' => $users]);
    }

    public function showTaskUpdatePage(string $id)
    {
        $statuses = Status::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        $task = Task::find($id);
        $labels = Label::orderBy('id')->get();
        return view('task-update-page', ['labels' => $labels, 'statuses' => $statuses, 'users' => $users, 'task' => $task]);
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
