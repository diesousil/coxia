<?php

namespace App\Services;

use App\Repositories\PersonalAccessTokenRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for PersonalAccessToken model
 */
class PersonalAccessTokenServiceValidator extends ServiceValidator
{
    public function __construct(PersonalAccessTokenRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a personal access token
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'user_id' => 'nullable|uuid|exists:users,id',
            'tokenable_type' => 'required|string|max:255',
            'tokenable_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'token' => 'required|string|max:64|unique:personal_access_tokens,token',
            'abilities' => 'nullable|string',
            'expires_at' => 'nullable|date',
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
     * Validate data for updating a personal access token
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'user_id' => 'sometimes|nullable|uuid|exists:users,id',
            'tokenable_type' => 'sometimes|required|string|max:255',
            'tokenable_id' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'token' => 'sometimes|required|string|max:64|unique:personal_access_tokens,token,'.$id,
            'abilities' => 'sometimes|nullable|string',
            'expires_at' => 'sometimes|nullable|date',
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
     * Validate data for deleting a personal access token
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
    }
}