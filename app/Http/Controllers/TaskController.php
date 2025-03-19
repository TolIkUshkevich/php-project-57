<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function create(TaskCreateRequest $request)
    {
        $validData = $request->validated();
        $validData['created_by_id'] = auth()->user()?->id;
        $task = Task::create($validData);
        $task->labels()->attach(($validData['labels'] ?? []));
        flash('Задача успешно создана')->success();
        return redirect()
            ->route('tasks.page');
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $validData = $request->validated();
        $task->update($validData);
        flash('Задача успешно изменена')->success();
        return redirect()
            ->route('tasks.page');
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        flash('Задача успешно удалена')->success();
        return redirect()
            ->route('tasks.page');
    }
}
