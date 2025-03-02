<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
                'required'
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
}
