<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for Ticket model
 */
class TicketServiceValidator extends ServiceValidator
{
    public function __construct(TicketRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a ticket
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'user_id' => 'nullable|uuid|exists:users,id',
            'order_id' => 'nullable|uuid|exists:orders,id',
            'qrcode_check' => 'required|string|max:255|unique:tickets,qrcode_check',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'errors' => $validator->errors(),
                ], 422)
            );
        }
    }

    /**
     * Validate data for updating a ticket
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'user_id' => 'sometimes|nullable|uuid|exists:users,id',
            'order_id' => 'sometimes|nullable|uuid|exists:orders,id',
            'qrcode_check' => 'sometimes|required|string|max:255|unique:tickets,qrcode_check,'.$id,
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'errors' => $validator->errors(),
                ], 422)
            );
        }
    }

    /**
     * Validate data for deleting a ticket
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
    }
}