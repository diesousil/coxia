<?php

namespace App\Services;

use App\Repositories\CacheRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validator for Cache model
 */
class CacheServiceValidator extends ServiceValidator
{
    public function __construct(CacheRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Validate data for creating a cache entry
     */
    public function validateCreate(array $data): void
    {
        $validator = validator($data, [
            'key' => 'required|string|unique:cache,key',
            'value' => 'required|string',
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
     * Validate data for updating a cache entry
     */
    public function validateEdit(array $data, string $id): void
    {
        $validator = validator($data, [
            'key' => 'sometimes|required|string|unique:cache,key,'.$id,
            'value' => 'sometimes|required|string',
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
     * Validate data for deleting a cache entry
     */
    public function validateDelete(string $id): void
    {
        // Additional validation for delete if needed
    }
}