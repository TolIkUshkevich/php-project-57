<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;

class TaskCreateRequest extends FormRequest
{
    protected $redirectRoute = 'task.create.page';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() and $this->user()->can('create', Task::class);
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
                Rule::unique(Task::class)
            ],
            'description' => [
                'nullable'
            ],
            'status_id' => [
                'required'
            ],
            'created_by_id' => [
                'nullable'
            ],
            'assigned_to_id' => [
                'nullable',
                Rule::exists(User::class, 'id')
            ],
            'labels' => [
                'array',
                'nullable'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Это обязательное поле',
            'status_id.required' => 'Это обязательное поле',
            'name.string' => 'Это поле должно быть строкой',
            'name.max' => 'The name must not be greater than 255 characters.',
            'name.unique' => 'Задача с таким именем уже существует'
        ];
    }
}
