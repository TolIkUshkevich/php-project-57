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
        Task::create($validData);
        return redirect()
            ->route('tasks.page');
    }

    public function update(TaskUpdateRequest $request, string $id)
    {
        $validData = $request->validated();
        $task = Task::find($id);
        $task->update($validData);
        return redirect()
            ->route('tasks.page');
    }

    public function destroy(Request $request, string $id)
    {
        $status = Task::find($id);
        $status->delete();
        return redirect()
            ->route('tasks.page');
    }
}
