<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Status;
use Illuminate\Validation\Rule;

class StatusUpdateRequest extends FormRequest
{
    protected $redirectRoute = 'status.update.page';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() and $this->user()->can('update', Status::class);;
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
                Rule::unique(Status::class)
            ]
        ];
    }
}
