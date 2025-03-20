<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Status;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatusCreateRequest extends FormRequest
{
    protected $redirectRoute = 'status.create.page';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool)$this->user() && $this->user()->can('create', Status::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Status::class)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.string' => 'Это поле должно быть строкой',
            'name.max' => 'The name must not be greater than 255 characters.',
            'name.unique' => 'Статус с таким именем уже существует'
        ];
    }
}
