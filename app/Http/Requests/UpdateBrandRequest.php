<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:brands|max:255',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'The Name field is required.',
            'Name.string' => 'The Name field must be a string.',
            'Name.unique' => 'The Name Brand is already in use.',
        ];
    }
}
