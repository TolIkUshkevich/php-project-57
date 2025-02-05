<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Validators\StatusValidator;

class StatusController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        $status = boolval(Status::where('name', $name)->first());
        $validator = new StatusValidator;
        if ($validator->creationValidate($name)) {
            Status::create(['name' => $name]);
            return redirect()
                ->route('statusesPage');
        } else {
            $errorData = $validator->errors();
            return redirect()
                ->route('statusCreate')
                ->with('error', $errorData)
                ->with('name', $name);
        }
    }
}
