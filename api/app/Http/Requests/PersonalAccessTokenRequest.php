<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Request validation for PersonalAccessToken model
 */
class PersonalAccessTokenRequest extends Request
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
            'user_id' => 'nullable|uuid|exists:users,id',
            'tokenable_type' => 'required|string|max:255',
            'tokenable_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'token' => 'required|string|max:64|unique:personal_access_tokens,token',
            'abilities' => 'nullable|string',
            'expires_at' => 'nullable|date',
        ];
    }

    /**
     * Get customized validation messages.
     */
    public function messages(): array
    {
        return [
            'user_id.uuid' => 'The user ID must be a valid UUID.',
            'user_id.exists' => 'The selected user does not exist.',
            'tokenable_type.required' => 'The tokenable type field is required.',
            'tokenable_id.required' => 'The tokenable ID field is required.',
            'name.required' => 'The name field is required.',
            'token.required' => 'The token field is required.',
            'token.unique' => 'The token has already been taken.',
            'token.max' => 'The token may not be greater than 64 characters.',
            'expires_at.date' => 'The expiration date must be a valid date.',
        ];
    }
}