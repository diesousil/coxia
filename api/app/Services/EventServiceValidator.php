<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for Event model
 */
class EventServiceValidator extends ServiceValidator
{
    public function __construct(EventRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating an event
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'user_id' => 'nullable|uuid|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_value' => 'nullable|numeric|between:0,99999999.99',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
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
     * Validate data for updating an event
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'user_id' => 'sometimes|nullable|uuid|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'unit_value' => 'sometimes|nullable|numeric|between:0,99999999.99',
            'starts_at' => 'sometimes|nullable|date',
            'ends_at' => 'sometimes|nullable|date|after_or_equal:starts_at',
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
     * Validate data for deleting an event
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
        // For example, check if event has associated orders that prevent deletion
    }
}