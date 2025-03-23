<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskDestroyRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Task;
use App\Models\Status;
use App\Models\Label;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->get();
        $users = User::orderBy('id')->get();
        $statuses = Status::orderBy('id')->get();
        /** @var array $selectedData */
        $selectedData = $request->query('filter') ?? [];
        return view('tasks-page', [
            'tasks' => $tasks,
            'page' => $page,
            'statuses' => $statuses,
            'users' => $users,
            ...$selectedData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $statuses = Status::orderBy('id')->get();
        $labels = Label::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('task-create-page', ['labels' => $labels, 'statuses' => $statuses, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request)
    {
        $validData = $request->validated();
        $validData['created_by_id'] = auth()->user()?->id;
        $task = Task::create($validData);
        $task->labels()->attach(($validData['labels'] ?? []));
        flash('Задача успешно создана')->success();
        return redirect()
            ->route('tasks.page');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        return view('task-page', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Task $task)
    {
        $statuses = Status::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        $labels = Label::orderBy('id')->get();
        return view('task-update-page', [
            'labels' => $labels,
            'statuses' => $statuses,
            'users' => $users,
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        flash('Задача успешно изменена')->success();
        return redirect()
            ->route('tasks.page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskDestroyRequest $request, Task $task)
    {
        $task->delete();
        flash('Задача успешно удалена')->success();
        return redirect()
            ->route('tasks.page');
    }
}
