<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Label;

class LabelUpdateRequest extends FormRequest
{
    protected $redirectRoute = 'label.update.page';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() and $this->user()->can('update', Label::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $label = $this->route('label');
        return [
            'name' => [
                'string',
                'required',
                'max:255',
                Rule::unique(Label::class)->ignore($label->id)
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
