<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;
use App\Models\User;

class TaskUpdateRequest extends FormRequest
{
    protected $redirectRoute = 'task.update.page';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() and $this->user()->can('update', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $task = $this->route('task');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Task::class)->ignore($task->id)
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'status_id' => [
                'required'
            ],
            'assigned_to_id' => [
                'nullable',
                Rule::exists(User::class, 'id')
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
