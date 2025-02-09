<?php

namespace App\Validators;

use Valitron\Validator as BaseValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserValidator
{
    private string $errorTitle = '';
    private string $errorContent = '';

    public function loginValidate(null|\App\Models\User $user, string $password): bool
    {
        if ($user and Hash::check($password, $user->password)) {
            return true;
        } else {
            $this->errorTitle = 'Упс! Что-то пошло не так:';
            $this->errorContent = 'Введите правильные имя пользователя и пароль';
            return false;
        }
    }

    public function registrationValidate($password, $passwordConfirmation, $email): bool
    {
        $validator = new BaseValidator(['password' => $password]);
        $validator->rule('lengthMin', 'password', 8);
        $valid = $validator->validate();
        $exists = DB::table('users')->where('email', $email)->exists();
        $confirmed = $password === $passwordConfirmation;
        if ($exists) {
            $this->errorTitle = 'Упс! Что-то пошло не так:';
            $this->errorContent = 'Пользователь с таким email уже существует';
        } elseif (!$valid) {
            $this->errorTitle = 'Упс! Что-то пошло не так:';
            $this->errorContent = 'Пароль должен иметь длину не менее 8 символов';
        } elseif (!$confirmed) {
            $this->errorTitle = 'Упс! Что-то пошло не так:';
            $this->errorContent = 'Пароль и подтверждение не совпадают';
        }
        return $valid and !$exists and $confirmed;

    }

    public function errors(): array
    {
        return ['errorTitle' => $this->errorTitle, 'errorContent' => $this->errorContent];
    }
}
