<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCreateRequest;
use App\Http\Requests\StatusEditRequest;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function create(StatusCreateRequest $request)
    {
        $name = $request->name;
        Status::create(['name' => $name]);
        return redirect()
            ->route('statuses.page');
    }

    public function update(StatusEditRequest $request, string $id)
    {
        $name = $request->name;
        $status = Status::find($id);
        $status->name = $name;
        $status->save();
        return redirect()
            ->route('statuses.page');
    }

    public function destroy(Request $request, string $id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect()
            ->route('statuses.page');
    }
}
