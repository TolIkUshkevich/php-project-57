<?php

namespace App\Validators;

use Illuminate\Support\Facades\DB;

class StatusValidator
{
    private $errorContent = '';

    public function errors(): array
    {
        return ['errorContent' => $this->errorContent];
    }

    public function creationValidate($name): bool
    {
        $exists = boolval(DB::table('statuses')->where('name', $name)->first());
        $validationResult = true;
        if ($exists) {
            $this->errorContent = 'Статус с таким именем уже существует';
            $validationResult = false;
        } elseif ($name == '') {
            $this->errorContent = 'Это обязательное поле';
            $validationResult = false;
        }
        return $validationResult;
    }
}