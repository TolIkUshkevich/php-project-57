<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCreateRequest;
use App\Http\Requests\StatusUpdateRequest;
use App\Http\Requests\StatusDestroyRequest;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function create(StatusCreateRequest $request)
    {
        $validData = $request->validated();
        $name = $validData['name'];
        Status::create(['name' => $name]);
        flash('Статус успешно создан')->success();
        return redirect()
            ->route('statuses.page');
    }

    public function update(StatusUpdateRequest $request, Status $status)
    {
        $name = $request->validated()['name'];
        $status->name = $name;
        $status->save();
        flash('Статус успешно изменён')->success();
        return redirect()
            ->route('statuses.page');
    }

    public function destroy(StatusDestroyRequest $request, Status $status)
    {
        try {
            $status->delete();
            flash('Статус успешно удалён')->success();
        } catch (\Illuminate\Database\QueryException) {
            flash('Не удалось удалить статус')->error();
        }
        return redirect()
            ->route('statuses.page');
    }
}
