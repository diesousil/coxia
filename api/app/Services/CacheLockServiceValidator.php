<?php

namespace App\Services;

use App\Repositories\CacheLockRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for CacheLock model
 */
class CacheLockServiceValidator extends ServiceValidator
{
    public function __construct(CacheLockRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a cache lock
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'key' => 'required|string|unique:cache_locks,key',
            'owner' => 'required|string|max:255',
            'expiration' => 'required|integer',
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
     * Validate data for updating a cache lock
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'key' => 'sometimes|required|string|unique:cache_locks,key,'.$id,
            'owner' => 'sometimes|required|string|max:255',
            'expiration' => 'sometimes|required|integer',
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
     * Validate data for deleting a cache lock
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
    }
}