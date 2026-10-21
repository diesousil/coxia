<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Request validation for Cache model
 */
class CacheRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): boolean
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|unique:cache,key',
            'value' => 'required|string',
            'expiration' => 'required|integer',
        ];
    }

    /**
     * Get customized validation messages.
     */
    public function messages(): array
    {
        return [
            'key.required' => 'The key field is required.',
            'key.unique' => 'The key has already been taken.',
            'value.required' => 'The value field is required.',
            'expiration.required' => 'The expiration field is required.',
            'expiration.integer' => 'The expiration must be an integer.',
        ];
    }
}