<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\PaymentStatusEnum;
use Illuminate\Validation\Rule;

/**
 * Validator for Order model
 */
class OrderServiceValidator extends ServiceValidator
{
    public function __construct(OrderRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating an order
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'user_id' => 'nullable|uuid|exists:users,id',
            'event_id' => 'nullable|uuid|exists:events,id',
            'status' => ['required', Rule::in(PaymentStatusEnum::cases())],
            'quantity' => 'nullable|integer|min:1',
            'total_value' => 'nullable|numeric|between:0,99999999.99',
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
     * Validate data for updating an order
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'user_id' => 'sometimes|nullable|uuid|exists:users,id',
            'event_id' => 'sometimes|nullable|uuid|exists:events,id',
            'status' => ['sometimes', 'required', Rule::in(PaymentStatusEnum::cases())],
            'quantity' => 'sometimes|nullable|integer|min:1',
            'total_value' => 'sometimes|nullable|numeric|between:0,99999999.99',
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
     * Validate data for deleting an order
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
        // For example, check if order has associated tickets that prevent deletion
    }
}