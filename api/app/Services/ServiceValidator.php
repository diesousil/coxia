<?php

namespace App\Services;

use App\Repositories\Repository;
use Illuminate\Validation\ValidationException;

abstract class ServiceValidator
{
    public function __construct(
        protected Repository $repository
    ) {}

    abstract public function validateCreate(array $data): void;

    abstract public function validateEdit(array $data, int|string $id): void;

    abstract public function validateDelete(int|string $id): void;

    protected function throwErrors(?array $errorMessages): void
    {
        if ($errorMessages && is_array($errorMessages) && count($errorMessages) > 0) {
            throw ValidationException::withMessages($errorMessages);
        }
    }
}
