<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Http\Requests\LabelCreateRequest;
use App\Http\Requests\LabelUpdateRequest;

class LabelController extends Controller
{
    public function create(LabelCreateRequest $request)
    {
        $validData = $request->validated();
        Label::create($validData);
        flash('Метка успешно создана')->success();
        return redirect()
            ->route('labels.page');
    }

    public function update(LabelUpdateRequest $request, Label $label)
    {
        $validData = $request->validated();
        $label->update($validData);
        flash('Метка успешно изменена')->success();
        return redirect()
            ->route('labels.page');
    }

    public function destroy(Request $request, Label $label)
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
