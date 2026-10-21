<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Request validation for Event model
 */
class EventRequest extends Request
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_value' => 'nullable|numeric|between:0,99999999.99',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
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
            'title.required' => 'The title field is required.',
            'unit_value.numeric' => 'The unit value must be a number.',
            'unit_value.between' => 'The unit value must be between 0 and 99999999.99.',
            'ends_at.after_or_equal' => 'The end date must be equal to or after the start date.',
        ];
    }
}