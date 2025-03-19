<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Label;

class LabelCreateRequest extends FormRequest
{
    protected $redirectRoute = 'labels.create.page';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool)$this->user() && $this->user()->can('create', Label::class);
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
                'string',
                'required',
                'max:255',
                Rule::unique(Label::class)
            ],
            'description' => [
                'nullable'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.string' => 'Это поле должно быть строкой',
            'name.max' => 'The name must not be greater than 255 characters.',
            'name.unique' => 'Метка с таким именем уже существует'
        ];
    }
}
