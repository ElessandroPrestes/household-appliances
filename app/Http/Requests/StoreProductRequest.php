<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products|max:255',
            'description' => 'required|string|max:150',
            'voltage' => 'required', Rule::in('110v', '220v'),
            'brand' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'The Name field is required.',
            'Name.string' => 'The Name field must be a string.',
            'Name.unique' => 'The Name Brand is already in use.',
            'Description.required' => 'The description field is required.',
            'Description.string' => 'The description field must be a string.',
            'Description.max' => 'The description field cannot exceed 150 characters.',
            'Voltage.required' => 'The voltage field is required.',
            'Voltage.in' => 'The voltage field must be either "110v" or "220v".',
            'brand.exists' => 'The brand ID does not exist in the products table.',

        ];
    }
}
