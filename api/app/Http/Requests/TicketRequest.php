<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Request validation for Ticket model
 */
class TicketRequest extends Request
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
            'order_id' => 'nullable|uuid|exists:orders,id',
            'qrcode_check' => 'required|string|max:255|unique:tickets,qrcode_check',
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
            'order_id.uuid' => 'The order ID must be a valid UUID.',
            'order_id.exists' => 'The selected order does not exist.',
            'qrcode_check.required' => 'The QR code check field is required.',
            'qrcode_check.unique' => 'The QR code check has already been taken.',
        ];
    }
}