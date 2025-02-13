<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCreateRequest;
use App\Models\Status;

class StatusController extends Controller
{
    public function create(StatusCreateRequest $request)
    {
        $name = $request->input('name');
        $status = boolval(Status::where('name', $name)->first());
            Status::create(['name' => $name]);
            return redirect()
                ->route('statuses.page');
    }

    public function edit(StatusEditRequest $request, string $id)
    {
        
    }
}
