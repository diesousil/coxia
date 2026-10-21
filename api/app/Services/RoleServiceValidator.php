<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for Role model
 */
class RoleServiceValidator extends ServiceValidator
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a role
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:roles,slug',
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
     * Validate data for updating a role
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'name' => 'sometimes|required|string|max:200',
            'slug' => 'sometimes|required|string|max:200|unique:roles,slug,'.$id,
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
     * Validate data for deleting a role
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
        // For example, check if role has associated users that prevent deletion
    }
}