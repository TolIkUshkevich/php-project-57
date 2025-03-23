<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCreateRequest;
use App\Http\Requests\StatusUpdateRequest;
use App\Http\Requests\StatusDestroyRequest;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::orderBy('id')->get();
        return view('statuses-page', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status-create-page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusCreateRequest $request)
    {
        $validData = $request->validated();
        $name = $validData['name'];
        Status::create(['name' => $name]);
        flash('Статус успешно создан')->success();
        return redirect()
            ->route('statuses.page');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        return view('status-update-page', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusUpdateRequest $request, Status $status)
    {
        $status->update($request->validated());
        flash('Статус успешно изменён')->success();
        return redirect()
            ->route('statuses.page');
    }

    /**
     * Remove the specified resource from storage.
     */
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
