<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\PaymentStatusEnum;

/**
 * Request validation for Order model
 */
class OrderRequest extends Request
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
            'event_id' => 'nullable|uuid|exists:events,id',
            'status' => ['required', Rule::in(PaymentStatusEnum::cases())],
            'quantity' => 'nullable|integer|min:1',
            'total_value' => 'nullable|numeric|between:0,99999999.99',
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
            'event_id.uuid' => 'The event ID must be a valid UUID.',
            'event_id.exists' => 'The selected event does not exist.',
            'status.required' => 'The status field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 1.',
            'total_value.numeric' => 'The total value must be a number.',
            'total_value.between' => 'The total value must be between 0 and 99999999.99.',
        ];
    }
}