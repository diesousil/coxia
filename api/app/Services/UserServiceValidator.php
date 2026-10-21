<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for User model
 */
class UserServiceValidator extends ServiceValidator
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a user
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|uuid|exists:roles,id',
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
     * Validate data for updating a user
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|required|string|min:8',
            'role_id' => 'sometimes|nullable|uuid|exists:roles,id',
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
     * Validate data for deleting a user
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
        // For example, check if user has related records that prevent deletion
    }
}