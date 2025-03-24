<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Http\Requests\LabelCreateRequest;
use App\Http\Requests\LabelUpdateRequest;
use App\Http\Requests\LabelDestroyRequest;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::orderBy('id')->get();
        return view('labels-page', ['labels' => $labels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('label-create-page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelCreateRequest $request)
    {
        Label::create($request->validated());
        flash('Метка успешно создана')->success();
        return redirect()
            ->route('labels.page');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('label-update-page', ['label' => $label]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelUpdateRequest $request, Label $label)
    {
        $label->update($request->validated());
        flash('Метка успешно изменена')->success();
        return redirect()
            ->route('labels.page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabelDestroyRequest $request, Label $label)
    {
        try {
            $label->delete();
            flash('Метка успешно удалена')->success();
        } catch (\Illuminate\Database\QueryException) {
            flash('Не удалось удалить метку')->error();
        }
        return redirect()
            ->route('labels.page');
    }
}
