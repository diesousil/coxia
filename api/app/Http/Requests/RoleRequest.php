<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Request validation for Role model
 */
class RoleRequest extends Request
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:roles,slug',
        ];
    }

    /**
     * Get customized validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'slug.required' => 'The slug field is required.',
            'slug.unique' => 'The slug has already been taken.',
        ];
    }
}